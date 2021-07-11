<template lang="pug">
.form-group
  label(v-if="hasLabelText") {{ labelText }}

</template>
<script>

export default {
   props: {
    labelText: String,
    default: ''
  },
  computed: {
    hasLabelText() {
      return this.labelText.trim().length > 0;
    }
  }
}
</script>
<style lang="scss" scoped>
label {
  margin-bottom: .5rem;
  font-size: .9rem;
  color: #3E3E3E;
}
</style>