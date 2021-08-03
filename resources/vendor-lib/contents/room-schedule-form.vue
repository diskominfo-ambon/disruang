<template lang="pug">
form.buysell-form(method="post", @submit.prevent="handleOnSubmit")
  .buysell-field.form-group
    .form-label-group
      label.form-label Pilih ruangan
    .dropdown.buysell-cc-dropdown
      a.buysell-cc-choosen.dropdown-indicator(href="#", data-toggle="dropdown")
        .coin-item.coin-btc
          .coin-icon
            em.icon.ni.ni-houzz

          .coin-info
            span.coin-name {{ rooms.isNotEmpty ? rooms.data[form.room_id].name.toUpperCase() : 'Memuat sebentar..' }}
            span.coin-text {{ rooms.isNotEmpty ? 'Tersedia jaringan wifi ': 'Sedang memuat data sebentar..' }}

        .dropdown-menu.dropdown-menu-auto.dropdown-menu-mxh
          ul.buysell-cc-list
              li.buysell-cc-item.selected(
                v-for="room, index in rooms.data" :key="room.id"
                @click="form.room_id = index"
              )
                a.buysell-cc-opt
                    .coin-item.coin-btc
                      .coin-icon
                        em.icon.ni.ni-houzz
                      .coin-info
                        span.coin-name {{ room.name.toUpperCase() }}
                        span.coin-text Tersedia jaringan wifi
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
              p(:class="form.range.start && 'is-filled'") {{ form.range.start ? rangeFormatterIntlId.start : 'Mulai kapan?' }}
            .date-picker__field
              span
                em.icon.ni.ni-swap
              em.icon.ni.ni-calendar-check-fill
              p(:class="form.range.end && 'is-filled'") {{ form.range.end ? rangeFormatterIntlId.end : 'Sampai kapan?' }}
      //- end

  .buysell-field.form-action
    button.btn.btn-lg.btn-block.btn-primary(
      :disabled="form.isSubmitting",
    ) {{ form.isSubmitting ? 'Sedang mengirim..' : 'Tambahkan kegiatan' }}

  .form-note.text-base.text-center Catatan: Pembuatan kegiatan akan dilakukan proses tinjauan.
</template>

<script>
import { computed, reactive } from 'vue';

import { DatePicker } from 'v-calendar';
import axios from 'axios';

export default {
  async setup() {
    const rooms = reactive({
      data: [],
      isNotEmpty: computed(() => rooms.data.length > 0),
    });

    const form = reactive({
      room_id: '',
      title: '',
      desc: '',
      range: {
        start: null,
        end: null,
      },
      isSubmitting: false,
    });


    // get rooms.
    const { data } = await axios.get('/api/rooms');

    form.room_id = 0;
    rooms.data = data.payload;


    const rangeFormatterIntlId = computed(() => {
      const start = datetimeFormatterIntlId(form.range.start);
      const end = datetimeFormatterIntlId(form.range.end);

      return {
        start,
        end
      }
    });

    function datetimeFormatterIntlId(date) {
      const dateIntl = new Intl.DateTimeFormat('id-ID', { dateStyle: 'long', timeStyle: 'short' })
        .format(date);

      return dateIntl.replaceAll('.', ':');
    }


    async function handleOnSubmit()
    {
      const uri = `${window.location.origin}/api/schedules`;

      try {

        await axios.post(uri, Object.assign(form));
        console.log('success submit');
        window.reload();
      } catch (err) {
        console.log('error submit');
        console.log({err});
      }
    }

    return {
      handleOnSubmit,
      rangeFormatterIntlId,
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
