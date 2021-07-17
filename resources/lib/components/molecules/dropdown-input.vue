<template lang="pug">
form-group
  .dropdown-field(@mouseenter="isToggle = true", @mousedown="isToggle = false")
    label.dropdown-field__placeholder(for="checkbox-dropdown")
      div
        i.fas.fa-door-closed
        p Pilih ruangan
      span.dropdown-icon(:class="isToggle && 'rotate-180'")
        i.fas.fa-caret-down
    transition(name="dropdown", mode="out-in")
      .dropdown-field__suggestions.shadow(v-show="isToggle")
        slot
</template>
<script>
import { ref } from 'vue';
import FormGroup from '~/components/atoms/form-group';

export default {
  setup() {
    const isToggle = ref(false);

    const handleOnToggle = () => {
      isToggle.value = !isToggle.value;
    };

    return {
      isToggle,
      handleOnToggle
    };
  },
  components: {
    FormGroup
  }
}
</script>

<style lang="scss" scoped>


.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 300ms ease;
}
.dropdown-enter-from,
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.dropdown-field {
  position: relative;
  p {
    margin: 0;
  }

  &__placeholder {
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;

    .dropdown-icon {
      transition: 300ms ease;
      &.rotate-180 {
        transform: rotate(-180deg);
      }
    }

    :first-child {
      display: flex;
      align-items: center;
      p {
        color: #8a93a7 !important;
        font-size: 1rem;
      }
      svg {
        color: #2283B5 !important;
        margin-right: .4rem;
      }

    }
    span svg {
      color: #2283B5 !important;
    }
  }


  &__suggestions {
    border: 1px solid #ced4da;
    background-color: #fff;
    position: absolute;
    top: 2.80rem;
    z-index: 3;
    left: 0;
    right: 0;
    border-radius: 0.25rem;
    overflow: scroll;
    width: 100%;
    max-height: 300px;
  }
}
</style>
