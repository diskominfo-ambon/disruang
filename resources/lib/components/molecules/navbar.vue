<template lang="pug">
nav.navbar.navbar-expand-lg.navbar-light.bg-white.shadow-sm
  .container
    a.navbar-brand(href="#") disruang
    button.navbar-toggler(
      type="button",
      data-bs-toggle="collapse",
      data-bs-target="#navbarNavAltMarkup",
      aria-controls="navbarNavAltMarkup",
      aria-expanded="false",
      aria-label="Toggle navigation"
    )
      span.navbar-toggler-icon

    #navbarNavAltMarkup.collapse.navbar-collapse
      .d-flex.align-items-center.justify-content-end.flex-1
      button.btn.btn-primary.text-white.btn-login
        i.fas.fa-sign-in-alt.text-white
        span.d-inline-block.ms-2 login

</template>

<style lang="scss" scoped>
.navbar {
  padding-top: .2rem;
  padding-bottom: .2rem;

  .btn-login {
    font-size: .9rem;
  }

  &-brand {
    transform: scale(1.3);
    color: #1BA0E2 !important;

    @media (max-width: 767.98px) {
      position: relative;
      left: 10px;
    }
  }
}
</style>