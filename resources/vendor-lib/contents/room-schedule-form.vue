<template lang="pug">
form.buysell-form(method="post", @submit.prevent="handlingSubmit")
  p.text-white.my-2.text-center.bg-danger.rounded-sm.py-1(v-if="form.meta.errors.isHasMessage") {{ form.meta.errors.message }}

  .buysell-field.form-group
    .form-label-group
      label.form-label Pilih ruangan
    .dropdown.buysell-cc-dropdown
      a.buysell-cc-choosen.dropdown-indicator(href="#", data-toggle="dropdown")
        .coin-item.coin-btc
          .coin-icon
            em.icon.ni.ni-houzz

          .coin-info
            span.coin-name {{ rooms.isNotEmpty ? form.room?.name.toUpperCase() : 'Memuat sebentar..' }}
            span.coin-text {{ rooms.isNotEmpty ? 'Tersedia jaringan wifi ': 'Sedang memuat data sebentar..' }}

        .dropdown-menu.dropdown-menu-auto.dropdown-menu-mxh
          ul.buysell-cc-list
              li.buysell-cc-item.selected(
                v-for="room in rooms.data" :key="room.id"
                @click="form.room_id = room.id"
              )
                a.buysell-cc-opt
                    .coin-item.coin-btc
                      .coin-icon
                        em.icon.ni.ni-houzz
                      .coin-info
                        span.coin-name {{ room.name.toUpperCase() }}
                        span.coin-text Tersedia jaringan wifi
    span.text-danger.d-block.mt-1(v-for="error in form.meta.errors.data?.room_id", :key="error") {{ error }}
  .buysell-field.form-group
    .form-label-group
      label.form-label(for="title") Judul kegiatan
    .form-control-group
      input.form-control.form-control-lg.form-control-number(
        id="title",
        name="title",
        placeholder="Contoh: kegiatan UMKM...",
        v-model="form.title"
      )
    .form-note-group
      span.buysell-min.form-note-alt Pastikan gunakan judul yang deskriptif
    span.text-danger.d-block.mt-1(v-for="error in form.meta.errors.data?.title", :key="error") {{ error }}

  .buysell-field.form-group
    .form-label-group
      label.form-label(for="desc") Deskripsi kegiatan&nbsp;
        em
          span.buysell-min.form-note-alt (Opsional)
    .form-control-group
      textarea.form-control.form-control-lg.form-control-number(
        name="desc",
        id="desc",
        maxlength="200",
        v-model="form.desc"
      )
      span.text-danger.d-block.mt-1(v-for="error in form.meta.errors.data?.desc", :key="error") {{ error }}

  .buysell-field.form-group
    .form-label-group
      label.form-label(for="booking-date") Booking pada
      //- datetime-picker
    .form-control-group
      date-picker(
        v-model="form.range",
        mode="dateTime"
        :columns="2",
        :locale="{ id: 'id', firstDayOfWeek: 3, masks: { weekdays: 'WWW', input: ['DD-MM-YY'] } }",
        is-range,
        is-expanded,
        is24hr
      )
        template(v-slot="{ inputValue, inputEvents, isDragging }")
          .date-picker__container(
            v-on="inputEvents.start"
          )
            .date-picker__field
              em.icon.ni.ni-calendar-fill
              p(:class="form.range.start && 'is-filled'") {{ form.meta.formatter.start }}
            .date-picker__field
              span
                em.icon.ni.ni-swap
              em.icon.ni.ni-calendar-check-fill
              p(:class="form.range.end && 'is-filled'") {{ form.meta.formatter.end }}
          span.text-danger.d-block.mt-1(v-for="error in form.meta.errors.data?.started_at", :key="error") *{{ error }}

          span.text-danger.d-block.mt-1(v-for="error in form.meta.errors.data?.ended_at", :key="error") *{{ error }}
      //- end

  .buysell-field.form-action
    button.btn.btn-lg.btn-block.btn-primary(
      :disabled="form.meta.isSubmitting",
    ) {{ form.meta.isSubmitting ? 'Sedang mengirim..' : 'Tambahkan kegiatan' }}

  .form-note.text-base.text-center Catatan: Pembuatan kegiatan akan dilakukan proses tinjauan.
</template>

<script>
import { computed, reactive, onMounted, onErrorCaptured } from 'vue';

import axios from 'axios';
import { DatePicker } from 'v-calendar';
import { pick, assign } from 'lodash';

import { formatter } from '~vendor/support/helpers/datetime-formatter';


function useFetch(url) {
  const endpoint = window.location.origin + url;

  return axios.get(endpoint)
    .then(res => res)
    .catch(err => {
      throw new Error(err);
    });
}

export default {
  async setup() {
    const rooms = reactive({
      data: [],
      isNotEmpty: computed(() => rooms.data.length > 0),
    });

    const form = reactive({
      room_id: null,
      room: computed(() => {
        return rooms.data.find(room => room.id === form.room_id)
      }),
      title: '',
      desc: '',
      range: {
        start: new Date(),
        end: null,
      },
      meta: {
        formatter: computed(() => {
          const format = formatter();

          return {
            start: format.full(form.range.start) ?? 'Mulai kapan?',
            end: form.range.end ? format.full(form.range.end) : 'Sampai kapan?'
          }
        }),
        isSubmitting: false,
        errors: {
          data: [],
          message: '',
          isHasMessage: computed(() => form.meta.errors.message.trim().length > 0),
          isNotEmpty: computed(() => form.meta.errors.data.length > 0)
        },
      }
    });

    // use fetch to fetching all of list rooms avaiable.
    try {

      const res = await useFetch('/api/rooms');

      if (res.data.payload.length > 0) {
        // set initial room.
        form.room_id = res.data.payload[0]?.id;
        rooms.data = res.data.payload;
      }

    } catch (err) {
      // handling error network..
    }



    // on mounted.
    onMounted(() => {
      // on mounted.
    });


    function handlingSubmit() {
      const uri = window.location.origin;
      const endpoint = uri + `/async/schedules`;

      // form fields.
      const body = assign({
        started_at: form.range.start,
        ended_at: form.range.end
      }, pick(form, ['room_id', 'title', 'desc', 'range']));

      // set initliaze form is submitted..
      form.meta.isSubmitting = true;
      form.meta.errors.data = [];
      form.meta.errors.message = '';

      axios.post(endpoint, body)
        .then(({data, status}) => {
          if (data.code === status &&
            data.payload.ajax.reload
          ) {
            // reload browser.
            window.location.reload();
          }

          if (data.code === status &&
            !data.payload.ajax.reload && data.payload.ajax.route.trim().length > 0
          ) {
            // redirect to route path.
            window.location.replace(data.payload.ajax.route);
          }
        })
        .catch(({response}) => {
          // is validation error.
          if (response.status === 422 && Object.keys(response.data.errors).length > 0) {
            form.meta.errors.data = response.data.errors;
          }

          if (response.status === 403 && !response.data.status) {
            form.meta.errors.message = response.data.message;
          }

        }).finally(() => {
          form.meta.isSubmitting = false;
        })
    }

    return {
      handlingSubmit,
      form,
      rooms
    }
  },


  components: {
    DatePicker
  }
}
</script>


<style lang="scss" scoped>

  .date-picker__container {
    display: flex;
    align-items: center;
    border: 1px solid #ced4da;
    border-radius: 3px;

    .date-picker__field {
      position: relative;
      padding: 20px;
      height: 74px;


      display: flex;
      align-items: center;
      flex: 1;
      .icon {
        color: #2283B5;
        margin-right: .5rem;
        width: 20px;
        transform: scale(1.2);
      }
      &:first-child {
        padding-right: .5rem;
      }
      &:last-child {
        padding-left: 1.5rem;
        span {
          position: absolute;
          left: -.93rem;
          background-color: white;
          border: 1px solid #ced4da;
          height: 1.56rem;
          width: 1.56rem;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          color: #0064d2 !important;
          em.icon {
            width: .91rem;
            height: .91rem;
            position: relative;
            left: .29rem;

          }
        }
        border-left: 1px dashed #ced4da;
      }
      p {
        margin: 0;
        margin-top: .0625rem;
        font-size: .90rem;
        color: #8a93a7 !important;
        &.is-filled {
          color: #35405a !important;
          font-size: .85rem;
        }
      }
    }
  }
</style>
