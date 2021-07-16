<template lang="pug">
heroes
  .row
    .col-12.col-md-5.offset-md-1.pt-2.pb-3
      h1.headline Tiada kesan tanpa kehadiranmu
      .subtitle
        p Ikut bersama membangun Kota Ambon Maluku
        span.text-dark Menjadi lebih baik
      .supported
        p Supported by
        div
          img.brand(src="/images/logo-kominfo.png", alt="logo kominfo")
          img.brand(src="/images/logo-pemkot.png", alt="logo pemkot")
    .col-12.col-md-6.py-2
      div
        ul.nav.nav-pills.bg-gray.rounded-2.mb-2.shadow-sm
          li.nav-item(@click="handleOnSelectTab('participant')")
            a.nav-link(
              :class="hasTabSelected.participant ? 'active' : ''",
              href="#"
            )
              i.fas.fa-ticket-alt
              span.d-inline-block.ms-2 Pesan ruangan
          li.nav-item(@click="handleOnSelectTab('roomGuest')")
            a.nav-link(
              :class="hasTabSelected.roomGuest ? 'active' : ''",
              href="#"
            )
              i.fas.fa-users
              span.d-inline-block.ms-2 Gabung kegiatan
        .card.shadow.border-none
          .card-body
            component(:is="selectedTab")
</template>
<script src="./scripts/headline-heroes.js"></script>


<style lang="scss" scoped>
.headline {
  display: flex;
  margin-top: 1.5rem;
  justify-content: center;
  flex-direction: column;
  .subtitle {
    display: flex;
    align-items: center;
    p {
      color: white;
    }
    span {
      background-color: white;
      border-radius: 2px;
      display: block;
      padding: 0.1rem 0.3rem;
      position: relative;
      top: -0.4rem;
      left: 0.5rem;
    }
  }
  .supported {
    p {
      color: #ddd !important;
    }
    div {
      margin: 0.5rem 0;
      img:last-child {
        margin-right: 0.5rem;
        width: 35px;
      }
      img {
        width: 40px;
        margin-top: -0.7rem;
        margin-right: 0.5rem;
        filter: saturate(10%);
      }
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
