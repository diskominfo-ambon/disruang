<template lang="pug">
heroes
  //- .form-overlay
  .row
    .col-12.col-md-5.offset-md-1.pt-2.pb-3
      h1.headline Tiada kesan tanpa kehadiranmu
      p.subtitle Ikut bersama-sama membangun Kota Ambon Maluku ✨
      .supported
        p Didukung oleh
        div
          img.brand(src="/images/logo-kominfo.png", alt="logo kominfo")
          img.brand(src="/images/logo-pemkot.png", alt="logo pemkot")
    .col-12.col-md-5.py-2
      .popup-relative
        ul.nav.nav-pills.bg-gray.rounded-2.mb-2.shadow-sm
          li.nav-item(@click="handleOnSelectTab('participant')")
            a.nav-link(
              :class="hasTabSelected.participant && 'active'",
              href="#"
            )
              i.fas.fa-ticket-alt
              span.d-inline-block.ms-2 Pesan ruangan
          li.nav-item(@click="handleOnSelectTab('roomGuest')")
            a.nav-link(
              :class="hasTabSelected.roomGuest && 'active'",
              href="#"
            )
              i.fas.fa-users
              span.d-inline-block.ms-2 Gabung kegiatan
        .card.shadow-sm.border-none
          .card-body
            component(:is="selectedTab")
</template>
<script src="./scripts/headline-heroes.js"></script>


<style lang="scss" scoped>
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
  padding: 0.3rem;
  width: max-content;

  @media (max-width: 767.98px) {
    width: 100%;
  }

  &-item {
    font-size: 0.9rem !important;
    cursor: pointer;
  }
}
</style>
