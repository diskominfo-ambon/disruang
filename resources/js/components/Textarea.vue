<template>
    <textarea v-model="localvalue" class="form-control"></textarea>
</template>

<script>

export default {
    name: 'Textarea',
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
