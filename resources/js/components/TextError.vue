<template>
  <p>{{ message }}</p>
</template>
<script>
export default {
  name: 'TextError',
  props: [
    'message'
  ]
}
</script>

<style scoped>
p {
  color: tomato;
  margin-top: .4rem;
}
</style>