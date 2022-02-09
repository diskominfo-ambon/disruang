<template>
  <div>
    <div class="alert alert-danger" v-if="alert">
      Catatan: {{ alert }}
    </div>

    <form method="POST" @submit.prevent="onSubmitted">
      <Divider labelText="1. Tambahkan kegiatan"/>
      <FormGroup 
        labelText="Pilih ruangan"
        >
        <VSelect
          v-model="form.room_id"
          :options="rooms"
        />
        <TextError :message="errors.room_id"/>
      </FormGroup>

      <FormGroup 
        labelText="Judul kegiatan"
        alertText="Pastikan gunakan judul yang deskriptif"
        >
        <Input type="text" v-model="form.title" />
        <TextError :message="errors.title"/>
      </FormGroup>

      <FormGroup 
        labelText="Deskripsi kegiatan"
        alertText="Kamu menambahkan informasi lengkap lainya terkait kegiatan ini seperti kontak, dll."
        >
        <Textarea v-model="form.desc" />
        <TextError :message="errors.desc"/>
      </FormGroup>

      <FormGroup labelText="Booking pada">
        <DateRangeInput
          v-model="form.date"
          :attributes="booked"
          :disabled="disabledDatePicker"
          :placeholders="['Mulai kapan?', 'Sampai kapan?']"
        />
        <TextError :message="errors.started_at"/>
        <TextError :message="errors.ended_at"/>
      </FormGroup>
      
      <button class="btn btn-primary">
        {{ computedTextButton }}
      </button>
    </form>
  </div>
</template>

<script>
import { mapValues } from 'lodash';
import VSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import useFetch from '~/utils/use-fetch';
import colors from '~/utils/colors-rand';
import constant from '~/constant';

import Input from './Input';
import Textarea from './Textarea';
import DateRangeInput from './DateRangeInput';
import FormGroup from './FormGroup';
import Divider from './Divider';
import FileUploader from './FileUploader';
import TextError from './TextError';

export default {
  props: {
    id: String,
    redirectUri: String,
    baseEndpoint: String,
  },
  components: {
    VSelect,
    FormGroup,
    Input,
    Textarea,
    Divider,
    FileUploader,
    DateRangeInput,
    TextError,
  },
  async mounted() {
    
    try {

      const res = await useFetch('/api/rooms');
      const rooms = res.data.payload;

      this.rooms = rooms.map(room => {
        const roomName = room.name.toUpperCase(); 
        
        return {
          label: `Ruangan ${roomName}`,
          id: room.id 
        }
      });

      await this.getBookedSchedules();
      
      if (this.id !== undefined) {
        const SCHEDULE_ENDPOINT = '/' + this.baseEndpoint + '/' + this.id;
        const { data } = await useFetch(SCHEDULE_ENDPOINT);

        const { title, desc, room_id, started_at, ended_at } = data.payload;
        
        const room = this.rooms.filter(room => room.id === room_id );

        this.form = { 
          title, 
          desc, 
          room_id: room[0], 
          dates: { start: new Date(schedule.started_at), end: new Date(schedule.ended_at) } 
        };

      }

    } catch {
      // Handle fetch error exception.
    }
  },
  computed: {
    computedTextButton() {
      return this.isLoading 
        ? 'Tunggu sebentar..'
        : this.id != null ? 'Simpan perubahan' : 'Buat kegiatan baru';
    }
  },
  methods: {
    onDateNavigation(event) {
      console.log('event on navgation');
      this.getBookedSchedules(event.month);
    },
    clearErrors() {
      this.errors = [];
    },
    async onSubmitted() {
      const ENDPOINT = this.id !== undefined
        ? '/' + this.baseEndpoint + '/' + this.id
        :  '/' + this.baseEndpoint;

      /**
       * Jika prop [id] di ketahui maka form tersebut digunakan untuk
       * 'edit' sebaliknya jika tidak maka untuk 'create'.
       */
      const METHOD = this.id !== undefined
        ? 'PUT'
        : 'POST';

      this.clearErrors();

      try {

        await window.axios({
          url: ENDPOINT,
          method: METHOD,
          data: {
            ...this.form,
            room_id: this.form.room_id?.id,
            started_at: this.form.date.start,
            ended_at: this.form.date.end,
          }
        });

        this.$emit('onFinished');

        if (this.redirectUri != undefined) {
          
          window.location.replace(this.redirectUri);
        }
      } catch (e) {
        console.log(e);
        const ENTITY_ISINVALID = 422;
        const FORBIDDEN = 403;
        const STATUS = e.response.status;
        const errors = e.response.data.errors;
        if (
          STATUS === ENTITY_ISINVALID
          && Object.keys(errors).length > 0
        ) {
          /**
           * Mengetahui jika respon status adalah ENTITY_INVALID maka
           * tampilkan hasil error formn dengan memetakan setiap [key] bidang
           * ke [key] errrornya.
           */
          this.errors = mapValues(errors, error => error[0]);
        }

        if (STATUS === FORBIDDEN) {
          this.alert = e.response.data.message;
        }
      }
    },
    async getBookedSchedules(month) {
      
      const currentMonth = month ?? (new Date().getMonth() + 1)
      const res = await useFetch('/api/schedules?month='+ currentMonth);
      const schedules = res.data.payload;
      
      this.booked = schedules.map(schedule => {
        const color = colors.alpha().random();
        return {
          key: schedule.id,
          highlight: {
            start: { fillMode: 'outline', color },
            base: { fillMode: 'light', color },
            end: { fillMode: 'outline', color },
          },
          popover: {
            label: 'Kegiatan '+ schedule.title
          },
          dates: {
            start: schedule.started_at,
            end: schedule.ended_at
          }
        }
      });

      this.disabledDatePicker = schedules.map(schedule => {
        return { start: schedule.started_at, end: schedule.ended_at };
      });
    }
  },
  data() {
    return {
      rooms: [],
      alert: null,
      isLoading: false,
      errors: [],
      booked: [],
      form: {
        room_id: null,
        title: '',
        desc: '',
        date: {
          start: new Date(),
          end: null
        },
      }
    }
  },
   
};
</script>

<style lang="css" scoped>

</style>