<template lang="pug">
form-group(:labelText="labelText", :errors="errors")
  label(v-if="hasLabelText") {{ labelText }}
  input.form-control
</template>

<script>
import FormGroup from "~/components/atoms/form-group";

export default {
  props: {
    labelText: String,
    default: "",
    required: false,
  },
  errors: {
    type: Array,
    required: false,
    default: [],
  },
  components: {
    FormGroup,
  },
};
</script>
