<template lang="pug">
nav.navbar.navbar-expand-lg.navbar-light.bg-transparent.navbar-top
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
      button.btn.btn-login
        i.fas.fa-sign-in-alt
        span.d-inline-block.ms-2 login

</template>

<style lang="scss" scoped>
.navbar {
  padding-top: .2rem;
  padding-bottom: .2rem;

  &-top {
    position: absolute;
    top: 2.5rem;
    left: 0;
    right: 0;
  }

  .btn-login {
    font-size: .9rem;
    color: #2F86CD !important;
    background-color: white;
  }

  &-brand {
    transform: scale(1.3);
    color: white !important;

    @media (max-width: 767.98px) {
      position: relative;
      left: 10px;
    }
  }
}
</style>
