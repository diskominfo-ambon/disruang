<template>
  <div>
    <form method="post" @submit.prevent="onSubmitted">
      <Divider labelText="2. Informasi kegiatan"/>

       <FormGroup labelText="Undang beberapa OPD">
        <VSelect
          multiple
          v-model="form.origins"
          :options="availableOrigins"
        />
        <TextError :message="errors.origins" />
      </FormGroup>

      <FormGroup labelText="Perlu menggundang ASN lainnya?">
        <VSelect
          v-model="form.asn_available"
          :options="[
            {label: 'Ya', id: 1},
            {label: 'Tidak', id: 0}
          ]"
        />
      </FormGroup>

      <FormGroup labelText="Undang beberapa ASN lainnya" v-if="isASNAvailable">
        <VSelect
          multiple
          v-model="form.employees"
          :options="availableEmployees"
        />
        <TextError :message="errors.employees" />
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
import VSelect from 'vue-select';
import Divider from './Divider';
import TextError from './TextError';
import FormGroup from './FormGroup'
import FileUploader from './FileUploader';

import { mapValues } from 'lodash';
import useFetch from '~/utils/use-fetch';

export default {
  name: 'ScheduleInfoForm',
  props: [
    'id', // Id kegiatan yang diambil dari basis data.
    'redirectUrl',
    'baseEndpoint',
  ],
  components: {
    VSelect,
    Divider,
    FormGroup,
    FileUploader,
    TextError
  },
  computed: {
    isASNAvailable() {
      return this.form.asn_available.id;
    }
  }, 
  data() {
    return {
      availableOptions: [
        {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
        {label: 'Tidak, hanya untuk ASN', id: 0}
      ],
      availableEmployees: [],
      availableOrigins: [],
      errors: [],
      form: {
        is_public: {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
        asn_available: {label: 'Tidak', id: 0},
        attachments: [],
        employees: [],
        files: [],
        origins: [],
      }
    }
  },
  methods: {
    async onSubmitted() {
      
      try {
        this.errors = [];
        const attachments = this.$refs.uploader.$refs.pond.getFiles().map( file => file.serverId);
        const employees = this.form.asn_available.id
          ? this.form.employees.map(employee => employee.id)
          : [];

        const body = {
          ...this.form,
          attachments,
          employees,
          origins: this.form.origins.map(origin => origin.id),
          is_public: this.form.is_public.id,
          asn_available: this.form.asn_available.id,
        };

    

        await window.axios.put(this.baseEndpoint + '/' + this.id + '/review', body);
        
        if (this.redirectUrl !== undefined) {
          window.location.replace(this.redirectUrl);
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

      }
    }
  },
  async mounted() {
    const $pondRef = this.$refs.uploader.$refs.pond;

    try {
      
      const { data } = await useFetch( '/async/schedules/' + this.id);

      const schedule = data.payload;
      console.log(schedule)

      const isAvailable = this.availableOptions.filter(item => item.id === schedule.is_public)[0];
      
      const { data: res } = await  useFetch('/api/employees');
      const employees = res.payload;

      const { data: result } = await useFetch('/api/origins');
      const origins = result.payload;

      this.availableEmployees = employees.map(employee => {
        return {
          label: `${employee.name} - ${employee.nip} ( ${employee?.origin.title.toUpperCase()} - ${employee.job_position})`,
          id: employee.id 
        }
      });

      this.availableOrigins = origins.map(origin => {
        return {
          label: origin.title.toUpperCase(),
          id: origin.id
        }
      });

      for (const attachment of schedule.attachments) {
        

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
        asn_available: schedule.origins.length > 0 ? { label: 'Ya', id: 1 } : {label: 'Tidak', id: 0 },
        origins: schedule.origins.map(origin => {
          return {label: origin.title.toUpperCase(), id: origin.id};
        }),
        employees: schedule.employees.map(employee => {
          return {label: `${employee.name} - ${employee.nip} ( ${employee?.origin.title.toUpperCase()} - ${employee.job_position})`, id: employee.id};
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