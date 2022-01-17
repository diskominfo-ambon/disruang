<template>
  <div>
    <Divider labelText="2. Informasi kegiatan"/>

    <FormGroup labelText="Undang beberapa ASN">
      <VSelect/>
    </FormGroup>

    <FormGroup labelText="Apa kegiatan bersifat umum?">
      <VSelect
        v-model="form.is_public"
        :options="[
          {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
          {label: 'Tidak, hanya untuk ASN', id: 0}
        ]"
      />
    </FormGroup>

    <FormGroup labelText="Unggah file materi">
      <FileUploader
        isMultiple
        endpoint="/async/attachments"
        availableFormats="application/pdf"
        placeholder="Tarik atau tekan untuk unggah"
      />
    </FormGroup>

    <button class="btn btn-primary">Simpan informasi kegiatan</button>
  </div>
</template>

<script>
import Divider from './Divider';
import FormGroup from './FormGroup'
import FileUploader from './FileUploader';
import VSelect from 'vue-select';

import useFetch from '~/utils/use-fetch';

export default {
  name: 'ScheduleInfoForm',
  props: [
    'id' // Id kegiatan yang diambil dari basis data.
  ],
  components: {
    Divider,
    FormGroup,
    FileUploader,
    VSelect,
  },
  data() {
    return {
      availableOptions: [
        {label: 'Ya, tersedia untuk ASN dan umum', id: true},
        {label: 'Tidak, hanya untuk ASN', id: false}
      ],
      form: {
        is_public: {},
        attachments: [],
        employees: []
      }
    }
  },
  computed: {
    getEndpoint() {
      return `/async/schedules/${this.id}`;
    }
  },
  methods: {
    async onSubmitted() {
      await window.axios.put(this.getEndpoint)
    }
  },
  async mounted() {
    try {
      const { data } = await useFetch(this.getEndpoint);

      const schedule = data.payload;
      const isAvailable = this.available.filter(item => item.id === schedule.isPublic)[0];
      
      this.form = {
        ...schedule,
        is_public: isAvailable
      };
      
    }catch {

    }
  }
}
</script>