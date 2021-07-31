<template lang="pug">
heroes
  transition(name='form-overlay' mode='out-in')
    .form-overlay(v-if="formOverlay", @mousedown="formOverlay = false")
  .row.py-5
    .col-sm-12.col-md-6.col-lg-4.offset-lg-2.pt-2.pb-3
      h1.headline Tiada kesan tanpa kehadiranmu
      p.subtitle Ikut bersama-sama membangun Kota Ambon Maluku
      .supported
        p Didukung oleh
        div
          img.brand(src="/images/logo-kominfo.png", alt="logo kominfo")
          img.brand(src="/images/logo-pemkot.png", alt="logo pemkot")
    .col-sm-12.col-md-6.col-lg-5.py-2
      .popup-relative
        .card.shadow.border-none(
          @mouseenter="formOverlay = true"
        )
          .card-body.position-relative
            participant-registration
</template>
<script src="./scripts/headline-heroes.js"></script>


<style lang="scss" scoped>


.form-overlay,
.form-overlay-leave-active {
  transition: all 400ms ease;
}
.form-overlay-enter-from,
.form-overlay-leave-to {
  opacity: 0;
}

.headline {
  margin-top: 1.2rem;
  color: white !important;
  font-size: 1.7rem;
}
.form-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(15, 23, 37, 0.911);
  z-index: 2;
  transition: all 300ms ease;
}
.subtitle {
  color: white !important;
  font-size: 1rem;
}

.popup-relative {
  position: relative;
  z-index: 3;
}
.supported {
  p {
    color: white !important;
    font-size: .9rem;
  }
  div {
    margin: 0.5rem 0;
    img:last-child {
      margin-right: 0;
      width: 35px;
    }
    img {
      width: 40px;
      margin-top: -0.2rem;
      margin-right: 1rem;
      filter: saturate(10%);
    }
  }
}

.nav {
  padding: 0.3rem .5rem;
  width: max-content;
  background-color: #f6f9ff;

  @media (max-width: 767.98px) {
    width: 100%;
  }

  &-item {
    font-size: 0.9rem !important;
    cursor: pointer;

    &:first-child {
      a {
        margin-right: .625rem;
      }
    }

    a {
      display: flex;
      align-items: center;
      flex-direction: column;
      padding: 0.6rem;
      border: 1px solid #c7d6f5;
      color: #8a93a7 !important;

      &.active {
        background-color: white !important;
        border-color:#0064D2;
        border-width: .125rem;
        color: #333333 !important;
      }

      img {
        width: 50px;
      }

      span {
        display: block;
        position: relative;
        left: -.4rem;
        top: .3rem;
        font-size: .7rem;
      }
    }

  }
}
</style>
