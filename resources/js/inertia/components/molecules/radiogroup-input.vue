<template>
<div class="form-group form-check">
  <div v-for="key in Object.keys(items)" :key="key">
    <input
      type="radio"
      class="form-check-input"
      :name="name"
      :id="`${name}-${key}`"
      :value="key"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <label class="form-check-label" :for="`${name}-${key}`">{{ items[key] }}</label>
  </div>
</div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
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
  }
});
</script>


<style lang="scss" scoped>
  .form-check {
    display: flex;
    align-items: center;

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
