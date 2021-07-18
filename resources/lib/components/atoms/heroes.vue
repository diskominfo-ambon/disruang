<template lang="pug">
.hero.hero-bg-gradient
  .container
    slot
</template>

<style lang="scss" scoped>
.hero {
  height: 14rem;
  max-height: 20.75rem;

  &-bg-gradient {
    background: linear-gradient(170deg, #69a6ce, #0770cd, #0064D2) !important;
  }
}
</style>
