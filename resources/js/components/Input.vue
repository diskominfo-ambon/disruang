<template>
    <input
        :type="type"
        :value="localvalue"
        :placeholder="placeholder"
        :class="isLarge && ''"
        class="form-control"
    />
</template>

<script>
import { computed } from 'vue';

export default {
    name: 'Input',
    props: [
        'isLarge',
        'placeholder',
        'value',
        'type'
    ],

    computed: {
        localvalue: {
            get() {
                return this.value;
            },
            set(value) {
               this.$emit('input', value);
            }
        }
    }
}
</script>
