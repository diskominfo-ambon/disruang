<template>
<section class="calendar">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-10 offset-md-1">
        <div class="calendar-headline">
          <img src="/images/ilustrations/reschedule.png" alt="schedule"/>
          <div>
            <h1 class="calendar-title">Jadwal kegiatan pemkot Ambon Maluku</h1>
            <p class="calendar-subtitle">
              Daftarkan kegiatan Anda dengan bergabung bersama kami
              <a class="is-link">disini.</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-4 offset-md-1">
        <calendar
          locale="id"
          title-position="right"
          :attributes="attrs"
          :masks="{weekdays: 'WWWW' }"
          @update:to-page="onCalendarChange"
          is-expanded
        />
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <p>
              Jadwal kegiatan {{ schedules.date }}
            </p>
          </div>
          <ul class="list-group list-group-flush" v-if="schedules.data.length > 0">
            <li class="list-group-item" v-for="schedule in schedules.data" :key="schedule.id">
              <div class="list-group-item__headline">
                <span>
                  <i class="fas fa-hashtag"></i>
                </span>
                <p class="list-group-item__title">
                  {{ schedule.title }}
                </p>
              </div>
              <p class="list-group-item__subtitle">
                {{ schedule.desc }}
              </p>
              <div class="list-group-item__meta">
                <div>
                  <i class="fas fa-user-tag"></i>
                  <span>{{ schedule.user.name }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <div>
                    <i class="fas fa-door-open"></i>
                    <span>{{ schedule.room.name }}</span>
                  </div>
                  <div>
                    <i class="fas fa-clock"></i>
                    <span>Pukul {{ schedule.started_at }} - {{ schedule.ended_at }}</span>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <!-- if schedules is empty -->
          <div class="mt-3 text-center" v-else>
            <p>
              Tidak tersedia kegiatan untuk bulan ini.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row"></div>
  </div>
</section>
</template>

<script>
import { defineComponent, ref, reactive } from '@vue/runtime-core';

import { Calendar } from 'v-calendar';

import colors from '~/support/helpers/colors-rand';
import { format, Formatter } from '~/support/helpers/datetime-formatter';
import useFetch from '~/support/helpers/use-fetch';

export default defineComponent({
  name: 'SectionInformation',
  components: {
    Calendar
  },
  setup() {
    // attribute schedules.
    const attrs = ref([]);
    // list of schedules.
    const schedules = reactive({
      date: null,
      data: []
    });

    async function onCalendarChange({month, year}) {
      const endpoint = `/api/schedules?month=${month}&${year}`;

      try {
        const { data, status } = await useFetch(endpoint);

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


          return {
            ...payload,
            started_at: format(payload.started_at)
              .toDate(Formatter.FULL)
              .value(),
            ended_at: format(payload.ended_at)
              .toTime(Formatter.FULL)
              .value()
              .replaceAll('.', ':')
          }
        });

        attrs.value = data.payload.map((schedule) => ({
          key: schedule.id,
          dot: colors.alpha().random(),
          popover: {
            label: schedule.title
          },
          dates: new Date(schedule.started_at)
        }));

        // add today highlight.
        attrs.value.push(
          {
            key: 'today',
            highlight: {
                fillMode: 'light',
            },
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
      attrs,
      onCalendarChange,
    }
  },
});
</script>


<style lang="scss" scoped>
.calendar {
  margin-top: 8rem !important;
  background-image: url(/images/svg/blue-wall.svg);
  background-position: center;
  padding-top: 10rem;
  padding-bottom: 7rem;
  background-size: cover;
  background-repeat: no-repeat;
  border-bottom: 1px solid #eee;

  @media screen and (max-width: 760px) {
    padding-top: 30rem;
  }

  &-headline {
    display: flex;
    margin-bottom: .80rem;

    img {
      width: 4rem;
      height: 3rem;
    }

    div {
      margin-left: .4rem;
    }
  }

  &-title {
    font-size: 1.5rem;
    font-weight: bolder;
  }

  &-subtitle {
    color: #8A93A7 !important;
    font-size: 0.9rem;
  }
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
        &__title {
          margin: 0;
          margin-left: .4rem;
          margin-bottom: .2rem;
          display: inline-block;
        }

        &__subtitle {
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
</style>
