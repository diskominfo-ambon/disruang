<template>
  <div id="app">
    <file-pond
      ref="pond"
      :files="files"
      v-model="localvalue"
      v-on:removefile="onRemoveFiled"
      :server="{
        url: endpoint,
        process: {
          headers: {
            'X-CSRF-TOKEN': csrfToken
          }
        }
      }"
      :label-idle="placeholder"
      :allow-multiple="isMultiple"
      :accepted-file-types="availableFormats"
    />
  </div>
</template>

<script>
import vueFilePond, { setOptions } from 'vue-filepond';
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import "filepond/dist/filepond.min.css";


const FilePond = vueFilePond(
  FilePondPluginFileValidateType
);

export default {
  name: 'FileUploader',
  props: [
    'files',
    'endpoint',
    'placeholder',
    'isMultiple',
    'availableFormats',
    'value'
  ],
  components: {
    FilePond
  },
  methods: {
    onRemoveFiled(err, body) {
      window.axios.delete(this.endpoint, {
        data: {
          id: body.source
        }
      })
    }
  },
  computed: {
    localvalue: {
      set(value) {
        this.$emit('input', value);
      },
      get() {
        return this.value;
      }
    }
  },
  data() {
    return {
      csrfToken: null
    }
  },
  mounted() {
    this.csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');
  }
}
</script>