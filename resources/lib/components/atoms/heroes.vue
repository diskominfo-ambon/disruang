<template lang="pug">
.hero.hero-bg-gradient
  .container
    slot
</template>

<style lang="scss" scoped>
.hero {
  height: 11.75rem;
  max-height: 12.75rem;

  &-bg-gradient {
    background: linear-gradient(170deg, #54b5ed, #2083b5, #0770cd) !important;
  }
}
</style>
