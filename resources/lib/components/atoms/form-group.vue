<template lang="pug">
.form-group
  label(v-if="hasLabelText",for="nameId") {{ labelText }}
  slot
  .errors(v-if="hasErrors")
    ul
      li(v-for="error in errors", :key="error") {{ error }}
</template>

<script>
export default {
  props: {
    labelText: {
      type: String,
      required: false,
      default: "",
    },
    nameId: {
      type: String,
      required: false,
      default: "",
    },
    errors: {
      type: Array,
      required: false,
      default: [],
    },
  },

  computed: {
    hasErrors() {
      return this.errors.length > 0;
    },
    hasLabelText() {
      return this.labelText.trim().length > 0;
    },
  },
};
</script>

<style lang="scss" scoped>
label {
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #8a93a7;
}
.errors {
  margin: 0.5rem 0;
}
</style>
