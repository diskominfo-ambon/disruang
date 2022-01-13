<template>
  <div class="form-group">
    <div class="form-label-group mb-2">
      <label class="form-label">{{ labelText }}</label>
    </div>
    <div class="form-control-group">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FormGroup',
  props: ['labelText']
}
</script>