<template>
    <textarea v-model="localvalue" class="form-control">{{ value }}</textarea>
</template>

<script>

export default {
    name: 'Textarea',
    props: [
        'value'
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
