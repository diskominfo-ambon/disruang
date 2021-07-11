<template lang="pug">
.alert(:class="`alert-${variant}`")
  span(v-if="hasMessage") {{ message }}
  slot(v-else)



</template>

<script>
export default {
  name: "Alert",
  computed: {
    hasMessage() {
      return this.message.trim().length > 0;
    }
  },
  props: {
    message: {
      type: String,
      default: "",
    },
    variant: {
      type: String,
      default: "warning",
    },
  },
};
</script>
