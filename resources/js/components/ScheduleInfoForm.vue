<template>
  <div>
    <Divider labelText="2. Informasi kegiatan"/>

    <FormGroup labelText="Undang beberapa ASN">
      <VSelect/>
    </FormGroup>

    <FormGroup labelText="Apa kegiatan bersifat umum?">
      <VSelect
        :options="[
          {label: 'Ya, tersedia untuk ASN dan umum', id: 1},
          {label: 'Tidak, hanya untuk ASN', id: 0}
        ]"
      />
    </FormGroup>

    <FormGroup labelText="Unggah file materi">
      <FileUploader
        isMultiple
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
  }
}
</script>