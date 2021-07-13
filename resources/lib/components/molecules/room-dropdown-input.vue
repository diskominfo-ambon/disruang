<template lang="pug">
form-group
  label(v-if="hasLabelText") {{ labelText }}
  p room dropdown input
</template>
<script>
import FormGroup from "~/components/atoms/form-group";
import DropdownInput from "~/components/atoms/dropdown-input";

export default {
  props: {
    labelText: String,
    default: "",
  },
  components: {
    FormGroup,
    DropdownInput,
  },
};
</script>
