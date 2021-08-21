<template>
  <form method="post" @submit.prevent="onSubmit">
    <text-input
      v-model="form.name"
      name="name"
      labelText="Nama lengkap"
      :errors="form.errors.name"
    />
    <text-input
      type="number"
      v-model="form.phoneNumber"
      name="phone_number"
      labelText="Nomor telepon"
      :errors="form.errors.phoneNumber"
    />

    <div class="form-group">
      <label class="form-label" for="gender">Jenis kelamin</label>
      <radiogroup-input
        name="gender"
        v-model="form.gender"
        :items="GENDER"
      />
      <error-text :message="form.errors.gender"/>
    </div>

    <div class="form-group form-information">
      <label class="form-label">Informasi pengguna</label>
      <checkbox-input name="asn" labelText="🙎‍♂️ Apakah Anda ASN?" @change="onAcceptAsn"/>
      <!-- Form ASN -->
      <transition name="asn" mode="out-in">
        <div class="asn__form" v-if="showASNForm">
          <p class="asn__form-title">Apakah Anda ASN?</p>
          <div class="d-flex align-items-center">
            <text-input
              name="origin"
              class="flex-1"
              v-model="form.asn.origin"
              labelText="Nama instansi"
            />
            <text-input
              name="origin_job_title"
              class="flex-1 ms-2"
              v-model="form.asn.jobTitle"
              labelText="Jabatan"
            />
          </div>
        </div>
      </transition>
      <!-- end -->
      <checkbox-input class="mb-0" @change="onAcceptSignature" labelText="💅🏻 Tekan untuk Tanda tangan." name="signature"/>
      <error-text :message="form.errors.signatureFile"/>

      <!-- Signature pad -->
      <transition name="signature" mode="in-out">
        <div class="signature-pad" v-show="showSignaturePad">
          <div class="signature-pad-header">
            <button type="button" class="btn btn-sm btn-success" @click="onAcceptedSignature">
              <i class="fas fa-check-circle"></i>
            </button>
            <button type="button" class="btn btn-sm btn-secondary" @click="signatureRef.clear()">
              <i class="fas fa-backspace"></i>
            </button>
          </div>
          <div class="signature-pad-content">
            <canvas id="signature-pad" width="600" height="300"></canvas>
          </div>
        </div>
      </transition>
      <!-- end -->
    </div>


    <!-- FIXME: dropdown suggestion in disable on clicked  -->
    <dropdown-input
      class="flex-1 mt-2 mb-0"
      labelText="Pilih kegiatan Anda"
      placeholderText="Telusuri kegiatan hari ini"
      v-model="form.schedule_id"
      :errors="form.errors.schedule_id"
    >
      <template #default>
        <div class="suggestion-item-selected">
          <p class="suggestion-title">{{ schedule.selected?.title }}</p>
          <div class="suggestion-meta">
            <p>
              <i class="fas fa-user-tag me-1"></i>
              <span>{{ schedule.selected?.user.name }}</span>
            </p>
            <p>
              <i class="fas fa-clock me-1"></i>
              <span>{{ schedule.selected?.started_at }} • {{ schedule.selected?.ended_at }}</span>
            </p>
          </div>
        </div>
      </template>

      <template #suggestion>
        <div class="py-2">
          <div class="suggestion-wrapper">
            <select-input
              name="room"
              labelText="Pilih ruangan"
              @change="onDropdownFilter"
              :items="rooms"
              :displayItem="room => `Ruangan ${room.name}`"
            />

            <p class="suggestion-label">Daftar kegiatan</p>
            <!-- is loading -->
            <div class="suggestion-loading" v-if="suggestions.loading">
              <p>👀 Sedang memuat tunggu...</p>
            </div>
            <!-- is empty -->
            <div class="suggestion-empty" v-else-if="suggestions.isEmpty">
              <p>🤷‍♂️ Kegiatan tidak tersedia untuk hari ini.</p>
            </div>

            <!-- is available -->
            <div v-else>
              <ul class="suggestion-items">
                <li class="suggestion-item"
                  v-for="suggestion in suggestions.data"
                  :key="suggestion.id"
                  @click="form.schedule_id = suggestion.id"
                >
                  <p class="suggestion-title">{{ suggestion.title }}</p>
                  <div class="suggestion-meta">
                    <p>
                      <i class="fas fa-user-tag me-1"></i>
                      <span>{{ suggestion.user.name }}</span>
                    </p>
                    <p>
                      <i class="fas fa-clock me-1"></i>
                      <span>{{ suggestion.started_at }} • {{ suggestion.ended_at }}</span>
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </template>
    </dropdown-input>


    <button class="btn btn-submit" :disabled="form.processing">
      {{ form.processing ? 'Tunggu sebentar..' : 'Mulai gabung' }}
    </button>
  </form>
</template>

<script>
import { ref, onMounted, reactive, computed } from 'vue';

import SignaturePad from 'signature_pad';
import { isObject, cloneDeep, forIn, merge, isEmpty } from 'lodash';
import { usePage, useForm } from '@inertiajs/inertia-vue3';

import TextInput from '~inertia/components/molecules/text-input';
import CheckboxInput from '~inertia/components/molecules/checkbox-input';
import RadiogroupInput from '~inertia/components/molecules/radiogroup-input';
import DropdownInput from '~inertia/components/molecules/dropdown-input';
import ErrorText from '~inertia/components/atoms/error-text';
import SelectInput from '~inertia/components/molecules/select-input';

import useFetch from '~/support/helpers/use-fetch';
import { format, Formatter } from '~/support/helpers/datetime-formatter';
import base64File from '~/support/helpers/base64-file';


export default {
   components: {

    // my components.
    TextInput,
    CheckboxInput,
    RadiogroupInput,
    DropdownInput,
    ErrorText,
    SelectInput
  },

  setup() {
    const $page = usePage();

    const showSignaturePad = ref(false);
    const showASNForm = ref(false);
    let signatureRef = ref(null);
    const form = useForm({
      name: '',
      gender: '',
      phoneNumber: '',
      asn: {
        origin: '',
        jobTitle: '',
      },
      signatureFile: '',
      schedule_id: '',
    });

    // list of room schedules.
    const suggestions = reactive({
      data: [],
      loading: false,
      isEmpty: computed(() => suggestions.data.length <= 0)
    });
    const schedule = reactive({
      selected: computed(() => suggestions.data.find(data => data.id === form.schedule_id)),
      isNotEmpty: computed(() => !isEmpty(schedule.selected))
    });
    const rooms = ref([]);

    onMounted(() => {
      // signature initilize inject.
      signatureRef.value = new SignaturePad(
        document.getElementById('signature-pad')
      );

      const endpoint = '/api/rooms';
      useFetch(endpoint)
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
      showASNForm.value = e.target.checked;
    }

    function onAcceptSignature(e) {
      showSignaturePad.value = e.target.checked;

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
      showSignaturePad.value = false;
    }

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
          console.log(errors);

          // my handling error.
        },
        onSuccess() {
          signatureRef.value.clear(); // clear signature pad in canvas.
          form.reset();

          console.log('success');
        }
      })
    }


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


      useFetch(endpoint, {
        beforeStart: () => {
          suggestions.loading = true;
        }
      })
        .then(({data, status}) => data.status && status === data.code
            ? Promise.resolve(data)
            : Promise.reject()
        )
        .then(data => {
          suggestions.data = data.payload.map(data => {

            return {
              ...data,
              started_at: format(data.started_at)
                .toDate(Formatter.LONG)
                .toTime(Formatter.LONG)
                .value(),

              ended_at: format(data.ended_at)
                .toDate(Formatter.LONG)
                .toTime(Formatter.LONG)
                .value()
            }
          });
        })
        .catch(err => {
          console.log(err);
        // error handling..
        }).finally(() => {
          suggestions.loading = false;
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
      suggestions,
      showSignaturePad,
      showASNForm,
      signatureRef,
      GENDER // var constant.
    }
  }
}
</script>

<style lang="scss" scoped>

.signature {
  &-enter-active,
  &-leave-active {
    transition: all 400ms ease;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
    filter: blur(2px);
    transform: translateY(200px);
    overflow: hidden;
  }

  &-pad {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: white;
    display: flex;
    flex-direction: column;
    border-radius: 4px;
    z-index: 7;

    &-header {
      background-color: #f6f9ff;
      border-bottom: 1px solid #f1f5ff;
      display: flex;
      align-items: center;
      border-radius: 4px 4px 0 0;
      justify-content: flex-end;
      padding: .3rem .5rem;

      button {
        margin-right: .3rem;
        color: white !important;

        &:last-child {
          margin-right: 0;
        }
      }
    }

    &-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  }

}

.asn {
  &-enter-active,
  &-leave-active {
    transition: all 300ms ease;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
    transform: translateY(-20px);
    overflow: hidden;
  }

  &__form {
    border: 1px solid #ced4da;
    border-radius: 3px;
    position: relative;
    padding: .5rem;
    margin: 1rem 0;

    &-title {
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

    :last-child {

      .form-group {
        margin-top: .9rem;
        margin-bottom: 0 !important;
      }
    }
  }
}

.form {
  &-information {
    margin: 0;
    > .form {
      &-label {
        margin-bottom: .1rem;
      }

      &-group {
        margin-bottom: 0 !important;
      }
    }
  }
}

.btn {
  &-submit {
    background-color: #F28C3D;
    border-color: #cf844b;
    margin-top: 1rem;
    color: white !important;
  }
}
.suggestion {

  &-label {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #8a93a7 !important;
    padding: 0 .6rem;
  }
  &-wrapper {
    .form-group {
      padding: 0 .6rem;
    }
  }
  &-loading, &-empty {
    display: flex;
    align-items: center;
    justify-content: center;

    p {
      margin-top: .5rem;
      margin-bottom: .8rem;
      color: #8a93a7 !important;
      font-size: 0.9rem;
    }
  }

  &-title {
    margin: 0;
    margin-bottom: .5rem;
  }
  &-items {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  &-item {
    border-bottom: 1px solid #ddd;
    padding: .6rem;
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
      margin: 0;
      color: #8a93a7 !important;
      span {
        margin-left: .3rem;
        display: block;
      }
    }
  }
}


</style>
