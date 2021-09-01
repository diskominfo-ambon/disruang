<template>
<div>
  <section class="hero hero-bg_gradient">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-5 offset-lg-1 pt-2 pb-3">
          <div class="hero-headline">
            <h1 class="hero-title">Tiada kesan tanpa kehadiranmu</h1>
            <p class="hero-subtitle">
              Ikut bersama-sama membangun Kota Ambon Maluku
            </p>
            <div class="hero-meta">
              <p>Didukung oleh</p>
              <div>
                <img src="/images/logo-kominfo.png" alt="logo kominfo"/>
                <img src="/images/logo-pemkot.png" alt="logo pemkot"/>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-5 py-2">
          <div class="card shadow-sm border-none">
            <div class="card-body" @mouseenter="overlay = true">
              <registrated-participant/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <schedule-information/>

  <guideline-information/>

  <footer-information/>

  <!-- overflay -->
  <transition name="overflay" mode="in-out">
    <div class="overflay-backdrop" v-if="overlay" @mousedown="overlay = false"></div>
  </transition>
  <!-- end -->


  <!-- modal -->
  <div v-show="flashMessage" class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="messageModalLabel">
            ✨Kamu berhasil melakukan pendaftaran
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img width="300" src="/images/ilustrations/teamwork.svg" alt="succes ilustration"/>
          <div>
            <p style="color: gray !important;">
              {{ flashMessage }}
            </p>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!-- end -->
</div>
</template>

<script>
import { computed, defineComponent, ref, watchEffect } from 'vue'

import { usePage } from '@inertiajs/inertia-vue3';

import FooterInformation from '~inertia/components/templates/footer-information';
import RegistratedParticipant from '~inertia/components/templates/registrated-participant';
import GuidelineInformation from '~inertia/components/templates/guideline-information';
import ScheduleInformation from '~inertia/components/templates/schedule-information';


export default defineComponent({
  name: 'Welcome',
  components: {
    RegistratedParticipant,
    GuidelineInformation,
    ScheduleInformation,
    FooterInformation
  },
  setup() {
    // form focus overlay.
    const overlay = ref(false);
    const $page = usePage();
    const flashMessage = computed(() =>  $page.props.value.flash.message);


    watchEffect(() => {
      if ($page.props.value.flash.message !== null) {
        new bootstrap.Modal(
          document.getElementById('messageModal')
        ).show();

        // disable form overflay.
        overlay.value = false;
      }
    });

    return {
      overlay,
      flashMessage
    }
  }

});

</script>

<style lang="scss" scoped>
.hero {
  height: 30rem;
  max-height: 30.75rem;



  &-bg {
    &_gradient {
      background: linear-gradient(170deg, #2E6DC5, #0770cd, #0064D2) !important;
    }
  }

  &-headline {
    position: relative;
    top: 4rem;
  }
  &-title {
    margin-top: 1.2rem;
    color: white !important;
    font-size: 1.7rem;
  }

  &-subtitle {
    color: white !important;
    font-size: 1rem;
  }

  &-meta {
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

  .card {
    margin-top: 3rem;

    @media screen and (max-width: 760px) {
      margin-top: 4rem;
    }
    &-body {
      position: relative;
      z-index: 5 !important;
      background-color: white;
      border-radius: 3px;
    }
  }
}

.overflay {
  &-leave-active {
    transition: all 400ms ease;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
  }

  &-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
    background: rgba(15, 23, 37, 0.911);
    transition: all 300ms ease;
  }
}
</style>
