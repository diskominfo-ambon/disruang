<template lang="pug">
form-group
  input.form-control(v-model="value", :type="type")
</template>

<script>
import FormGroup from "~/components/atoms/form-group";

export default {
  props: {
    modelValue: {
      type: String
    },
    type: {
      type: String,
      default: 'text'
    }
  },
  emits: ['update:modelValue'],
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      }
    }
  },
  components: {
    FormGroup,
  },
};
</script>
