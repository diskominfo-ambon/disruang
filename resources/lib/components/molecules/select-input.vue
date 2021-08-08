<template lang="pug">
form-group
  select.form-select(v-model="value")
    slot
      option(v-for="key in Object.keys(items)", :value="key", :key="key") {{ items[key] }}

</template>



<script>
import FormGroup from '~/components/atoms/form-group';

export default {
  props: {
    modelValue: {
      type: String,
    },
    items: {
      type: Object,
    }
  },
  emits: ['update:modelValue'],
  computed: {
    value: {
      get() {
        return this.modelValue || (Object.keys(this.items)[0] ?? '');
      },
      set(val) {
        this.$emit('update:modelValue', val);
      }
    }
  },
  components: {
    FormGroup
  }
}
</script>
