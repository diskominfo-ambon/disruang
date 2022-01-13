<template>
  <div id="app">
    <file-pond
      :label-idle="placeholder"
      :allow-multiple="isMultiple"
      :accepted-file-types="availableFormats"
    />
  </div>
</template>

<script>
import getFilePondInstance from 'vue-filepond';
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import "filepond/dist/filepond.min.css";

const FilePond = getFilePondInstance(
  FilePondPluginFileValidateType
);

export default {
  name: 'FileUploader',
  props: [
    'placeholder',
    'isMultiple',
    'availableFormats'
  ],
  components: {
    FilePond
  },
}
</script>