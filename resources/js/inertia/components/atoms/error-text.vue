<template>
  <span class="error-text" v-if="message.trim().length > 0">{{ prefix }} {{ message }}</span>
</template>
<script>
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
  name: 'ErrorText',
  props: {
    prefix: {
      default: ''
    },
    message: {
      type: String,
      default: ''
    }
  }
});
</script>
