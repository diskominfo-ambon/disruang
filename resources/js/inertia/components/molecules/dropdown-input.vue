<template>
<div class="form-group dropdown-field">
  <label class="form-label">{{ labelText }}</label>

  <div class="dropdown-field-container" @click="isToggle = true">
    <div class="dropdown-field-body">
      <!-- content -->
      <i class="fas fa-door-closed dropdown-icon"></i>

      <div v-if="value.length <= 0" class="dropdown-placeholder">
        {{ placeholderText }}
      </div>

      <div v-else>
        <slot></slot>
      </div>
    </div>

    <div class="dropdown-arrow" :class="isToggle && 'active'">
      <i class="fas fa-caret-down dropdown-icon"></i>
    </div>
  </div>

  <transition name="dropdown" mode="out-in">
    <div class="dropdown-suggestion shadow" v-show="isToggle" @mouseleave="isToggle = false">
      <!-- suggestion -->
      <slot name="suggestion" :hide="hideDropdown"></slot>
    </div>
  </transition>

  <error-text :message="errors" v-if="errors.length > 0"/>
</div>

</template>
<script>
import { ref, defineComponent } from 'vue';

import ErrorText from '~inertia/components/atoms/error-text';

export default defineComponent({
  props: {
    placeholderText: String,
    labelText: String,
    modelValue: String,
    errors: {
      type: String,
      default: ''
    }
  },
  components: {
    ErrorText
  },
  setup() {
    const isToggle = ref(false);

    function hideDropdown() {
        isToggle.value = false;
    }

    return {
      isToggle,
      hideDropdown
    };
  },
  computed: {
    value: {
      set(value) {
        this.$emit('update:modelValue', value);
      },
      get() {
        return this.modelValue;
      }
    }
  }
});
</script>

<style lang="scss" scoped>
.dropdown {
  &-enter-active,
  &-leave-active {
    transition: all 300ms ease;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }

  &-field {
    position: relative;
    &-container {
      background-clip: padding-box;
      padding: 0.475rem 0.75rem;
      border-radius: 0.25rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid #ced4da;
    }

    &-body {
      display: flex;

      svg {
        margin-right: .6rem;
        margin-top: .3rem;
      }
    }

  }
  &-placeholder {
    color: #808080;
    font-size: .97rem;
  }

  &-icon {
    color: #2283B5 !important;
    margin-right: .4rem;
  }

  &-arrow  {
    transition: 200ms ease;
    &.active {
      transform: rotate(180deg);
    }
  }

  &-suggestion {
    border: 1px solid #ced4da;
    background-color: #fff;
    position: absolute;
    z-index: 4;
    top: 4.8rem;
    left: 0;
    right: 0;
    border-radius: 0.25rem;
    overflow: scroll;
    width: 100%;
    max-height: 300px;
  }
}
</style>
