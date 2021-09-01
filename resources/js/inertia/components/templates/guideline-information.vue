<template>
<section class="guideline">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-5 offset-md-1">
        <div class="guideline-headline">
          <img src="/images/ilustrations/guideline.png" alt="guideline"/>
          <div>
            <h4 class="fw-bold">Kemudahan dalam mengikuti kegiatan</h4>
            <p>
              Memberikan kamu informasi serta kemudahan dalam mengikuti kegiatan.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-11 offset-md-1">
        <ul class="guideline-steps">
          <li class="guideline-step">
            <div>
              <img src="/images/ilustrations/reschedule.png" alt=""/>
            </div>
            <div>
              <h5>Pilih jadwal kegiatanmu</h5>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
              </p>
            </div>
          </li>
          <li class="guideline-step">
            <div>
              <img src="/images/ilustrations/profile.png" alt=""/>
            </div>
            <div>
              <h5>Mendaftar pada kegiatan</h5>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
              </p>
            </div>
          </li>
          <li class="guideline-step">
            <div>
              <img src="/images/ilustrations/easy-ticket.png" alt=""/>
            </div>
            <div>
              <h5>Mendapatkan tiket</h5>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
              </p>
            </div>
          </li>
          <li class="guideline-step">
            <div>
              <img src="/images/ilustrations/rewards.png" alt=""/>
            </div>
            <div>
              <h5>Berhasil bergabung kegiatan</h5>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

</template>



<style lang="scss" scoped>
.guideline {
  margin: 2rem 0;

  @media screen and (max-width: 760px) {

  }

  &-headline {
    display: flex;
    margin-bottom: .5rem;

    div:first-child {
      margin-right: .6rem;
    }

    img {
      width: 4.80rem !important;
      height: 3.80rem;
    }
    p {
      color: #8A93A7 !important;
      font-size: .9rem;
    }
  }

  &-steps {
    list-style: none;
    margin: 0;
    margin-top: -2rem;
    padding: 0;
    display: flex;

    @media screen and (max-width: 760px) {
      display: block;
    }
  }

  &-step {
    @media screen and (max-width) {
      margin-bottom: .9rem;
    }

    :first-child {
      margin-top: 1rem;

    }

    p {
      font-size: .8rem;
      color: #8A93A7 !important;
    }


    img {
      width: 50px;
    }
  }

  &-headline {
    display: flex;
    margin-bottom: .5rem;

    div:first-child {
      margin-right: .6rem;
    }

    img {
      width: 4.4rem;
    }
    p {
      color: #8A93A7 !important;
      font-size: .9rem;
    }
  }
}

</style>
