<template lang="pug">
form-group
  input.form-check-input(type="checkbox")
</template>
<script>
import FormGroup from "~/components/atoms/form-group";
export default {
  components: {
    FormGroup,
  },
};
</script>
<style lang="scss" scoped>
.form-group {
  display: flex;
  align-items: center;

  &.form-switch {
    .form-check-input {
      width: 3em;
      height: 1.6em;
      &:not(:checked) {
        background-color: #ddd;
      }
    }
  }

  input[type="checkbox"] {
    order: -1;
    margin-right: 0.5rem;
    display: block;
    position: relative;
    top: -0.3rem;
  }
}
</style>
