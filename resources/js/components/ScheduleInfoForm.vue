<template>
  <div>
    <form method="post" @submit.prevent="onSubmitted">
      <Divider labelText="2. Informasi kegiatan"/>
      <FormGroup labelText="Undang beberapa ASN">
        <VSelect
          multiple
          v-model="form.employees"
          :options="availableEmployees"
        />
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

      <FormGroup labelText="Unggah file materi (Opsional)">
        <FileUploader
          isMultiple
          ref="uploader"
          :files="form.files"
          endpoint="/async/attachments"
          availableFormats="application/pdf"
          placeholder="Tarik atau tekan untuk unggah"
        />
      </FormGroup>

      <button class="btn btn-primary">Simpan informasi kegiatan</button>
    </form>
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
    'id', // Id kegiatan yang diambil dari basis data.
    'redirectUrl',
    'baseEndpoint',
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
        {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
        {label: 'Tidak, hanya untuk ASN', id: 0}
      ],
      availableEmployees: [],
      form: {
        is_public: {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
        attachments: [],
        employees: [],
        files: [],
      }
    }
  },
  methods: {
    async onSubmitted() {
      
      try {
        const attachments = this.$refs.uploader.$refs.pond.getFiles().map( file => file.serverId);
        const body = {
          ...this.form,
          attachments,
          employees: this.form.employees.map(employee => employee.id),
          is_public: this.form.is_public.id,
        };

        await window.axios.put(this.baseEndpoint + '/' + this.id + '/review', body);
        
        if (this.redirectUrl !== undefined) {
          window.location.replace(this.redirectUrl);
        }
      } catch (e) {
        console.log(e);
        console.log('gagal');
      }
    }
  },
  async mounted() {
    const $pondRef = this.$refs.uploader.$refs.pond;

    try {
      
      const { data } = await useFetch(this.baseEndpoint + '/' + this.id);

      const schedule = data.payload;
      const isAvailable = this.availableOptions.filter(item => item.id === schedule.is_public)[0];
      
      const { data: res } = await  useFetch('/api/employees');
      const employees = res.payload;

      this.availableEmployees = employees.map(employee => {
        return {
          label: `${employee.name} - ${employee.nip}`,
          id: employee.id 
        }
      });

      for (const attachment of schedule.attachments) {
        const path = window.location.origin + '/storage/' + attachment.path;
        const file = new File([attachment.filename], attachment.original_filename, {
          type: attachment.content_type,
          size: attachment.size
        });

        this.form.files.push({
          source: attachment.id,
          options: {
            type: 'local',
            file: {
              name: attachment.original_filename,
              type: attachment.content_type,
              size: attachment.size
            }
          }
        });
      }

      this.form = {
        ...this.form,
        ...schedule,
        employees: schedule.employees.map(employee => {
          return {label: `${employee.name} - ${employee.nip}`, id: employee.id};
        }),
        is_public: isAvailable
      };
      
    }catch (e) {
      console.log(e);
      console.log('error');
    }
  }
}
</script>