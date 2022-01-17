<template>
  <div>
    <form method="POST">
      <Divider labelText="1. Tambahkan kegiatan"/>
      <FormGroup 
        labelText="Pilih ruangan"
        >
        <VSelect/>
      </FormGroup>

      <FormGroup 
        labelText="Judul kegiatan"
        alertText="Pastikan gunakan judul yang deskriptif"
        >
        <Input type="text" isLarge/>
      </FormGroup>

      <FormGroup 
        labelText="Deskripsi kegiatan"
        alertText="Kamu menambahkan informasi lengkap lainya terkait kegiatan ini seperti kontak, dll."
        >
        <Textarea />
      </FormGroup>

      <FormGroup labelText="Booking pada">
        <DateRangeInput :placeholders="['Mulai kapan?', 'Sampai kapan?']"/>
      </FormGroup>
      
      <button class="btn btn-primary">
        Buat kegiatan baru
      </button>
    </form>
  </div>
</template>

<script>
import VSelect from 'vue-select';

import 'vue-select/dist/vue-select.css';


import useFetch from '~/utils/use-fetch';
import constant from '~/constant';

import Input from './Input';
import Textarea from './Textarea';
import DateRangeInput from './DateRangeInput';
import FormGroup from './FormGroup';
import Divider from './Divider';
import FileUploader from './FileUploader';

export default {
  props: ['initialData'],
  components: {
    VSelect,
    FormGroup,
    Input,
    Textarea,
    Divider,
    FileUploader,
    DateRangeInput,
  },
  mounted() {
    console.log('mounted..');
  },
  data() {
    return {
      form: {
        roomId: null,
        title: '',
        description: '',
        date: {
          start: new Date(),
          end: null
        },
        employees: [],
        isPublicAvailable: true,
        attachments: []
      }
    }
  },
   
};
</script>

<style lang="css" scoped>

</style>