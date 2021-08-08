<template lang="pug">
form(method="post", @submit.prevent="onSubmit")
  text-input(labelText="Nama lengkap", v-model="form.name")
  span.error-text(v-if="form.errors.name") {{ form.errors.name }}

  text-input(
    type="number",
    labelText="Nomor telepon",
    v-model="form.phoneNumber"
  )
  span.error-text(v-if="form.errors.phoneNumber") {{ form.errors.phoneNumber }}

  .d-flex.align-items-center
    radio-group-input(
      labelText="Jenis kelamin",
      name='gender',
      v-model="form.gender"
      :items="GENDER"
    )
  span.error-text(v-if="form.errors.gender") {{ form.errors.gender }}

  .form-group.mb-0
    label.form-label Informasi pengguna
      .d-flex.align-items-start.mt-1
        checkbox-input.me-3(
          labelText="Tanda tangan",
          @change="onAcceptSignature"
        )
        checkbox-input(labelText="Saya ASN?", @change="onAcceptAsn")

  span.error-text(v-if="form.errors.signature") {{ form.errors.signature }}
  //- form if he asn
  transition(name='form-asn' mode='out-in')
    .form-is-asn(v-if="showAsnForm")
      p Saya ASN
      .d-flex.align-items-center
        text-input.flex-1.me-2(labelText="Nama instansi ASN?", v-model="form.asn.originName")
        text-input.flex-1(labelText="Jabatan ASN?", v-model="form.asn.jobTitle")

  span.error-text(v-if="form.errors.schedule_id") {{ form.errors.schedule_id }}
  .d-flex.align-items-center.justify-content-end
    dropdown-input.flex-1.me-3(
      labelText="Pilih kegiatan yang tersedia",
      placeholderText="Kegiatan terbaik kamu"
    )
      template(#default)
        .suggestion-item-selected(v-if="schedule.isNotEmpty")
          p.suggestion-title {{ schedule.selected.title }}
          .suggestion-meta
            p
              i.fas.fa-user-tag.me-1
              span {{ schedule.selected.user.name }}
            p.mt-1
              i.fas.fa-clock.me-1
              span {{ schedule.selected.started_at }} • {{ schedule.selected.ended_at }}
        p.m-0(v-else) Pilih kegiatan terbaik Anda

      template(#suggestion)
        //- suggestion
        .py-3.px-2
          .suggestions
            .form-group
              label.form-label Pilih ruangan
              select.form-select(@change="onDropdownFilter")
                option(v-for="room in rooms", :value="room.id", :key="room.id") Ruangan {{ room.name }}
            .suggestion-loading(v-if="dropdownSuggestions.loading")
              p 👀 Sedang memuat tunggu...
            .suggestion-empty(v-else-if="dropdownSuggestions.isEmpty")
              p 🤷‍♂️ Kegiatan tidak tersedia untuk hari ini.
            div(v-else)
              p.label Daftar kegiatan
              ul.suggestions
                li.suggestion-item(
                    v-for="data in dropdownSuggestions.data",
                    :key="data.id",
                    @click="form.schedule_id = data.id"
                  )
                  p.suggestion-title {{ data.title }}
                  .suggestion-meta
                    p
                      i.fas.fa-user-tag.me-1
                      span {{ data.user.name }}
                    p.mt-1
                      i.fas.fa-clock.me-1
                      span {{ data.started_at }} • {{ data.ended_at }}
        //- end

    button.btn.btn-orange.btn-submit(
      :disabled="form.processing"
    ) {{ form.processing ? 'Tunggu sebentar..' : 'Mulai gabung' }}

  //- signature modal
  transition(name="signature-modal", mode="out-in")
    .signature-modal(v-show="showSignatureModal")
      .signature-modal__header
        button.btn.btn-sm.text-success(
          type="button",
          @click="onAcceptedSignature"
        )
          i.fas.fa-check-circle
        button.btn.btn-sm.text-secondary(
          type="button",
          @click="signatureRef.clear()"
        )
          i.fas.fa-backspace

      .signature-modal__content
        canvas(
          id="signature",
          width="600",
          height="300"
        )
</template>
<script>
import { ref, onMounted, reactive, computed } from 'vue';

import SignaturePad from 'signature_pad';
import { isObject, cloneDeep, forIn, merge, isEmpty } from 'lodash';
import { usePage, useForm } from '@inertiajs/inertia-vue3';

import TextInput from '~/components/molecules/text-input';
import CheckboxInput from '~/components/molecules/checkbox-input';
import RadioGroupInput from '~/components/molecules/radio-group-input';
import DropdownInput from '~/components/molecules/dropdown-input';
import formatter from '~/support/utils/datetime-formatter';


function base64File(dataURL) {
  let array = [];
  let binary = atob(dataURL.split(',')[1]);
  const type = dataURL.split(',')[0].split(':')[1].split(';')[0];
  const ext = type.split('/')[1];
  array = [];

  let it = 0;
  while (it < binary.length) {
    array.push(binary.charCodeAt(it));
    it++;
  }
  const blob = new Blob([new Uint8Array(array)], {
    type
  });

  return new File([blob], `image.${ext}`, {
    type
  });
}


export default {
   components: {

    // my components.
    TextInput,
    CheckboxInput,
    RadioGroupInput,
    DropdownInput
  },

  setup() {
    const showSignatureModal = ref(false);
    const showAsnForm = ref(false);
    const $page = usePage();
    let signatureRef = ref(null);

    const form = useForm({
      name: '',
      gender: '',
      phoneNumber: '',
      asn: {
        originName: '',
        jobTitle: '',
      },
      signatureFile: '',
      schedule_id: '',
    });

    // list of room schedules.
    const dropdownSuggestions = reactive({
      data: [],
      loading: false,
      isEmpty: computed(() => dropdownSuggestions.data.length <= 0)
    });
    const schedule = reactive({
      selected: computed(() => dropdownSuggestions.data.find(data => data.id === form.schedule_id)),
      isNotEmpty: computed(() => !isEmpty(schedule.selected))
    });
    const rooms = ref([]);

    onMounted(() => {
      // signature initilize inject.
      signatureRef.value = new SignaturePad(
        document.getElementById('signature')
      );


      const endpoint = '/api/rooms';
      axios.get(endpoint)
        .then(({data, status}) => {
          return data.status && status === data.code
            ? Promise.resolve(data)
            : Promise.reject();
        })
        .then(data => {
          rooms.value = data.payload;
          if (data.payload.length > 0) {
            fetchScheduleByRoomId(data.payload[0].id)
          }
        })
        .catch(err => {
          console.log(err);
          // error handling..
        });

    });

    function onAcceptAsn(e) {
      showAsnForm.value = e.target.checked;
    }

    function onAcceptSignature(e) {
      showSignatureModal.value = e.target.checked;

      if (!e.target.checked) {
        // set signature to empty string.
        form.signatureFile = '';
      }
    }


    function onAcceptedSignature() {
      if (signatureRef.value.isEmpty()) {
        alert('Lengkapi tanda tangan terlebih dahulu');
        return;
      }

      form.signatureFile = base64File(signatureRef.value.toDataURL()); // set signature value to image - base64.
      showSignatureModal.value = false;
    }

    /**
     * ! please refactor.
     */
    function onSubmit() {
      const endpoint = '/async/participants/new';

      const formData = new FormData();
      const body = merge(cloneDeep(form), {
        _token: $page.props.value.csrf
      });

      forIn(body, onForIn);

      function onForIn(value, key) {
        if (isObject(value)) {
          forIn(value, onForIn);
        }

        formData.append(key, value);
      }


      form.post(endpoint, {
        forceFormData: true,
        onStart() {
          form.clearErrors();
        },
        onFinish() {

          console.log('finish');
        },
        onError(errors) {
          console.warn('Error');

          // my handling error.
        },
        onSuccess() {
          signatureRef.value.clear(); // clear signature pad in canvas.
          window.location.reload(); //reload browser.
          form.reset();

          console.log('success');
        }
      })
    }




    /**
     * ! plese use composite api [refactor].
     */

    function onDropdownFilter(e) {
      const roomId = e.target.value;

      fetchScheduleByRoomId(roomId)

    }


    function fetchScheduleByRoomId(id) {
      const date = new Date();

      // find all schedule for this date.
      let endpoint = '/api/rooms/'+ id
        + '?day='+ date.getDate()
        + '&month='+ ( date.getMonth() + 1)
        + '&year='+ date.getFullYear();

      dropdownSuggestions.loading = true;

      axios.get(endpoint)
        .then(({data, status}) => {
          return data.status && status === data.code
            ? Promise.resolve(data)
            : Promise.reject();
        })
        .then(data => {
          dropdownSuggestions.data = data.payload.map(data => {
            const format = formatter();

            return {
              ...data,
              started_at: format.full(new Date(data.started_at)),
              ended_at: format.full(new Date(data.ended_at)),
            }
          });
        })
        .catch(err => {
          console.log(err);
        // error handling..
        }).finally(() => {
          dropdownSuggestions.loading = false;
        })
    }


    const GENDER = {
      L: 'Laki-laki',
      P: 'Perempuan'
    };

    return {
      onAcceptAsn,
      onSubmit,
      onAcceptSignature,
      onAcceptedSignature,
      onDropdownFilter,
      form,
      rooms,
      schedule,
      dropdownSuggestions,
      showSignatureModal,
      showAsnForm,
      signatureRef,
      GENDER // var constant.
    }
  }
}
</script>
<style lang="scss" scoped>

// vue transition
.signature-modal,
.signature-modal-leave-active,
.form-asn,
.form-asn-leave-active {
  transition: all 400ms ease;
}
.signature-modal-enter-from,
.signature-modal-leave-to {
  opacity: 0;
  filter: blur(2px);
  transform: translateY(200px);
}

.form-asn-enter-from,
.form-asn-leave-to {
  opacity: 0;
  filter: blur(2px);
  transform: translateY(-50px);
}

// end

.label {
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #8a93a7 !important;
}
.error-text {
  display: block;
  margin-bottom: .3rem;
  color: tomato;
  font-size: .8rem;
}

.suggestions {
  margin-top: .8rem;
  ul {
    padding: 0;
    margin: 0;
    list-style: none;
  }

}
.suggestion {
  &-loading, &-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    p {
      margin: 0;
      margin-top: .5rem;
      color: #8a93a7 !important;
      font-size: 0.9rem;
    }
  }
  &-title {
    margin: 0;
    margin-bottom: .5rem;
  }
  &-item {
    border-bottom: 1px solid #ddd;
    padding: .5rem;
    cursor: pointer;

    &:hover {
      background-color: #eee;
    }

    &-selected {
      border: none;
      flex: 1;
      display: block !important;

      .suggestion-title {
        margin: 0rem;
      }
    }
  }



  &-meta {
    margin-top: .5rem;

    p {
      font-size: .8rem !important;
      display: flex;
      align-items: center;
      margin: 0;
      color: #8a93a7 !important;
    }
  }
}



.form-is-asn {
  border: 1px solid #ced4da;
  border-radius: 3px;
  position: relative;
  padding: .6rem;
  margin: 1rem 0;
  p {
    margin: 0;
    position: absolute;
    top: -.7rem;
    color: #2283B5 !important;
    border-radius: 2px;
    border: 1px solid #ced4da;
    padding: .1rem .3rem;
    font-size: .9rem;
    background-color: white;
  }

  div {
    margin-top: .5rem;
  }

}
.signature-modal {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: white;
  display: flex;
  flex-direction: column;
  border-radius: 4px;

  &__header {
    background-color: #f6f9ff;
    border-bottom: 1px solid #f1f5ff;
    display: flex;
    align-items: center;
    border-radius: 4px 4px 0 0;
    justify-content: flex-end;
    padding: .3rem .5rem;

    button {
      margin-right: .3rem;

      &:last-child {
        margin-right: 0;
      }
    }
  }
  &__content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;

    .placeholder {
      color: #8a93a7;
      display: flex;
      align-items: center;
      flex-direction: column;
      p {
        color: #8a93a7 !important;
        margin-top: .4rem;
      }
    }
  }
}
.signature-label {
  display: block;
  color: #2283B5;
  font-size: .8rem;
  margin-left: -.2rem;
  cursor: pointer;
}
.signature-meta {
  display: flex;
  border: 1px solid #ced4da;
  padding: .2rem .5rem;
  border-radius: 4px;
  align-items: center;
  position: relative;

  &:hover {
    background-color: #eee;
  }

  svg {
    margin-right: .6rem;
    color: #2283B5 !important;
  }

}
.form-dropdown {
  margin: 0;
}
.btn-submit {
  margin-top: 1.8rem;
}
</style>
