<template>
  <div>
    <p>{{ labelText }}</p>
    <hr/>
  </div>
</template>

<script>

export default {
  name: 'Divider',
  props: ['labelText']
}

</script>