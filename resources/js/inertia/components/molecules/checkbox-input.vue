<template>
<div class="form-group form-check">
  <input type="checkbox" :name="name" :id="name" class="form-check-input"/>
  <label class="form-label" :for="name">{{ labelText }}</label>
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
    labelText: {
      type: String
    }
  }
});
</script>

<style lang="scss" scoped>
.form {
  &-group {
    display: flex;
    align-items: center;
  }
  &-check {
    &-input {
      &:not(:checked) {
        background-color: #ddd;
      }
    }
  }

  &-label {
    margin-top: .7rem;
    margin-left: .5rem;
  }
}
</style>
