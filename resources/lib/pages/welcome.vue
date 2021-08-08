<template lang="pug">
div
  alert.text-center.alert-radiusless.alert-sm.alert-b.alert-b-blue(variant="secondary") Semua yang perlu kamu ketahui tentang status dan kebijakan kegiatan selama wabah virus&nbsp;
    a.is-link(href="") Corona.

  alert.text-center.alert-radiusless.alert-sm(
      variant="success",
      v-if="$page.props.value.flash.message !== null"
    ) {{ $page.props.value.flash.message }}

  navbar
  headline-heroes

  section.guideline-container
    .container
      .row
        .col-sm-12.col-md-11.offset-md-1
          .guideline-headline
            div
                img(src="/images/ilustrations/guideline.png")
            div
              h4.fw-bold Kemudahan dalam mengikuti kegiatan
              p Memberikan kamu informasi serta kemudahan dalam mengikuti kegiatan.
      .row
        .col-sm-12.col-md-5.offset-md-1
          ul.guideline-steps
            li.guideline-step
              div
                img(src="/images/ilustrations/reschedule.png")
              div
                h5 Pilih jadwal kegiatanmu
                p Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
            li.guideline-step
              div
                img(src="/images/ilustrations/profile.png")
              div
                h5 Mendaftar pada kegiatan
                p Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
        .col-sm-12.col-md-5
          ul.guideline-steps
            li.guideline-step
              div
                img(src="/images/ilustrations/easy-ticket.png")
              div
                h5 Mendapatkan tiket
                p Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
            li.guideline-step
              div
                img(src="/images/ilustrations/rewards.png")
              div
                h5 Berhasil bergabung bersama kegiatan
                p Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic debitis eius facilis, similique cumque eum et iure accusantium, expedita ipsa dicta sed temporibus ad aliquid nihil fugiat ex aperiam. Aut?
  section.calendar-container
    .container
      .row
        .col-sm-12.col-md-11.offset-md-1
          .calendar-headline
            div
              img(src="/images/ilustrations/reschedule.png")
            div
              h4.fw-bold Jadwal kegiatan pemkot Ambon Maluku
              p Daftarkan kegiatan Anda dengan bergabung bersama kami,&nbsp;
                a.is-link(href="#") disini.
      .row
        .col-sm-12.col-md-4.offset-md-1
          calendar(
            locale="id"
            title-position="right",
            :attributes="attributeSchedules"
            :masks="{weekdays: 'WWWW' }"
            @update:to-page="onCalendarChange"
            is-expanded
          )
        .col-sm-12.col-md-6
          .card
            .card-header
              p Jadwal kegiatan {{ schedules.date }}

            ul.list-group.list-group-flush(v-if="schedules.data.length > 0")
              li.list-group-item(v-for="schedule in schedules.data", :key="schedule.id")
                div
                  span
                    i.fas.fa-hashtag
                  p.title {{ schedule.title }}
                p.subtitle {{ schedule.desc }}
                .list-group-item__meta
                  div
                    i.fas.fa-user-tag
                    span {{ schedule.user.name }}
                  .d-flex.align-items-center
                    div
                      i.fas.fa-door-open
                      span {{ schedule.room.name }}
                    div •
                    div
                      i.fas.fa-clock
                      span Pukul {{ schedule.started_at }} - {{ schedule.ended_at }}
            .mt-3.text-center(v-else)
              p Tidak tersedia kegiatan untuk bulan ini.

  footer.container
    .row
      .col-sm-12
        h3.text-primary disruang
        span Dibuat dengan penuh 💖 dari teman-teman dan untuk teman-teman &copy; 2021.


</template>

<script>
import { ref, reactive } from 'vue';

import { Calendar } from 'v-calendar';
import { usePage } from '@inertiajs/inertia-vue3';

import Alert from "~/components/atoms/alert";
import Navbar from "~/components/molecules/navbar";
import HeadlineHeroes from "~/components/templates/welcome/headline-heroes";

import colors from '~/support/utils/colors-rand';
import formatter from '~/support/utils/datetime-formatter';



export default {
  setup() {
    const attributeSchedules = ref([]);
    // list of schedules.
    const schedules = reactive({
      date: null,
      data: []
    });

    const $page = usePage();

    async function onCalendarChange({month, year}) {
      const endpoint = `/api/schedules?month=${month}&${year}`;

      try {
        const { data, status } = await axios.get(endpoint);

        if (data.code !== status || !data.status) {
          throw new Error('Error: response code not match.');
        }
        const monthNames = [
          'Januari', 'Februari', 'Maret', 'April', 'Mei',
          'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
          'Nopember', 'Desember'
        ];

        // set initial data schedules.
        schedules.date = `${monthNames[month - 1]} ${year}`;
        schedules.data = data.payload.map(function (payload) {
          const format = formatter();

          return {
            ...payload,
            started_at: format.full(new Date(payload.started_at)),
            ended_at: format.full(new Date(payload.ended_at)),
          }
        });

        attributeSchedules.value = data.payload.map((schedule) => ({
          key: schedule.id,
          dot: colors.alpha().random(),
          popover: {
            label: schedule.title
          },
          dates: new Date(schedule.started_at)
        }));

        // add today highlight.
        attributeSchedules.value.push(
          {
            key: 'today',
            highlight: true,
            popover: {
              label: 'Hari ini'
            },
            dates: new Date(),
          }
        );

      }catch (err) {
        console.log(err);
      }

    }


    return {
      schedules,
      $page,
      attributeSchedules,
      onCalendarChange,
    }
  },
  components: {
    Calendar,
    // my components
    Alert,
    Navbar,
    HeadlineHeroes,
  },
};
</script>

<style lang="scss" scoped>

.guideline {
  &-container {
    margin-top: 12rem;
    @media screen and (max-width: 760px) {
      margin-top: 25rem;
    }
  }

  &-steps {
    list-style: none;
    margin: 0;
    margin-top: .6rem;
    padding: 0;
  }

  &-step {
    display: flex;
    margin-bottom: .9rem;

    &:last-child {
      margin-bottom: 0;
    }

    p {
      font-size: .8rem;
      color: #8A93A7 !important;
    }

    div:first-child {
      margin-right: .7rem;
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
.calendar {
  &-container {
    margin-top: 1rem !important;
    background-image: url(/images/svg/blue-wall.svg);
    background-position: center;
    padding-top: 9rem;
    padding-bottom: 1rem;
    background-size: cover;
    background-repeat: no-repeat;
    border-bottom: 1px solid #eee;

    .card {
      border-color: #CBD5E0;

      @media screen and (max-width: 760px) {
        margin-top: 1rem;
      }

      &-header {
        background-color: #F6F9FF !important;

        p {
          margin: 0;

          &::before {
            content: '';
            height: 10px;
            width: 10px;
            display: inline-block;
            margin-right: .5rem;
            border-radius: 55%;
            background-color: #066ECD;
          }
        }
      }
      .list-group {
        max-height: 15.2rem;
        overflow-y: scroll;

        &-item {
          .title {
            margin: 0;
            margin-left: .4rem;
            margin-bottom: .2rem;
            display: inline-block;
          }

          .subtitle {
            font-size: .9rem;
            margin-bottom: .3rem;
          }


          &__meta {

            div {
              margin-right: .5rem;
              color: #8A93A7;


              &:last-child {
                margin: 0;
              }
            }

            svg {
              width: .9rem;
              color: #8A93A7;
            }
            span {
              font-size: .8rem;
              margin-left: .3rem;
              color: #8A93A7 !important;
            }
          }
        }
      }
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

footer {
  padding: .7rem 0;
  @media screen and (max-width: 760px) {
    padding: .7rem 1rem;
  }

  h3 {
    margin: 0;
  }
  span {
    color: #8A93A7 !important;
    font-size: .8rem;
  }
}
</style>
