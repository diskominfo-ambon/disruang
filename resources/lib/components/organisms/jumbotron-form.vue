<template lang="pug">
.hero.hero-bg-gradient
  .container
    .row
      .col-12.col-md-5.offset-md-1.pt-5.pb-3
        .headline
          h1.fs-3.text-white Tiada kesan tanpa kehadiranmu
          .subtitle
            p.text-white Ikut bersama membangun Kota Ambon Maluku
            span.text-dark Menjadi lebih baik
          .supporter-info
            p Supported by
            div
              img.brand(src="/images/logo-kominfo.png", alt="logo kominfo")
              img.brand(src="/images/logo-pemkot.png", alt="logo pemkot")

      .col-12.col-md-6.py-2
        form-tabs-container
</template>
<script>
import FormTabsContainer from '~/components/molecules/form-tabs-container';

export default {
  components: {
    FormTabsContainer
  }
}
</script>

<style lang="scss" scoped>
.hero {
  max-height: 18.75rem;
  &-bg-gradient {
    background: linear-gradient(170deg, #54B5ED,  #2083B5, #0770CD) !important;
  }
  .headline {
    display: flex;
    margin-top: 1.5rem;
    justify-content: center;
    flex-direction: column;
    .subtitle {
      display: flex;
      align-items: center;

      span {
        background-color: white;
        border-radius: 2px;
        display: block;
        padding: .1rem .3rem;
        position: relative;
        top: -.4rem;
        left: .5rem;
      }
    }
    .supporter-info {
      display: flex;
      align-items: center;
      p {
        color: #ddd !important;
      }
      div {
        margin: .5rem 0;
        margin-left: .7rem;
        img:last-child {
          margin-right: .5rem;
          width: 35px;
        }
        img {
          width: 40px;
          margin-top: -.7rem;
          margin-right: .5rem;
          filter: saturate(10%);
        }
      }
    }
  }
}
</style>