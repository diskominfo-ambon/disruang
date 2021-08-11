<template>
  <div class="form-group">
    <label class="form-label" :for="name">{{ labelText }}</label>
    <select :name="name" :id="name" class="form-select">
      <option v-for="item in items" :key="item?.id" :value="item.id"> {{ displayItem(item) }} </option>
    </select>
  </div>
</template>
<script>
export default {
  props: ['labelText', 'name', 'displayItem', 'items']
}
</script>
