<template lang="pug">
form-group
  .form-check.d-flex.align-items-center
    div(v-for="key in Object.keys(items)")
      input.form-check-input(
        type="radio",
        @input="$emit('update:modelValue', $event.target.value)"
        :value="key",
        :name="name",
        :id="`${name}-${items[key]}`"
      )
      label.form-check-label(:for="`${name}-${items[key]}`") {{ items[key] }}
</template>

<script>
import FormGroup from "~/components/atoms/form-group";
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    items: {
      type: Array,
      default: [],
      required: true,
    }
  },
  components: {
    FormGroup
  }
};
</script>


<style lang="scss" scoped>
  .form-check {
    &-label {
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
      color: #8a93a7;
    }

    div:first-child {
      margin-right: 3rem;
    }

  }
</style>
