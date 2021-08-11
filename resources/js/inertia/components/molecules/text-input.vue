<template>
<div class="form-group">
  <label class="form-label">{{ labelText }}</label>
  <input
    :type="type"
    class="form-control"
    v-model="value"
    :id="name"
    :name="name"
  />
  <!-- has error message. -->
  <error-text v-if="errors.length > 0" :message="errors"/>
</div>
</template>

<script>
import { defineComponent } from 'vue';

import ErrorText from '~inertia/components/atoms/error-text';

export default defineComponent({
  props: {
    modelValue: {
      type: String
    },
    type: {
      type: String,
      default: 'text'
    },
    name: String,
    labelText: String,
    errors: {
      type: String,
      default: '',
    }
  },
  emits: ['update:modelValue'],
  components: {
    ErrorText
  },
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      }
    }
  }
});
</script>
