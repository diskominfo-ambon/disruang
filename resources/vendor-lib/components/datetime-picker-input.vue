<template lang="pug">
date-picker(
    v-model="range",
    mode="dateTime"
    @change="console.log('change')"
    :columns="2",
    :locale="{ id: 'id', firstDayOfWeek: 3, masks: { weekdays: 'WWW', input: ['DD-MM-YY'] } }",
    is-range,
    is-expanded,
    is24hr
  )

  template(v-slot="{ inputValue, inputEvents, isDragging }")
    .date-picker__container(
      v-on="inputEvents.start"
    )
      .date-picker__field
        em.icon.ni.ni-calendar-fill
        p(:class="range.start && 'is-filled'") {{ range.start ? dateTimeFormatter.start : 'Mulai kapan?' }}
      .date-picker__field
        span
          em.icon.ni.ni-swap

        em.icon.ni.ni-calendar-check-fill
        p(:class="range.end && 'is-filled'") {{ range.end ? dateTimeFormatter.end : 'Sampai kapan?' }}

</template>
<script>
import { DatePicker } from 'v-calendar';
import { ref, computed } from 'vue';


export default {
  props: {
    modelValue: {
      type: String
    },
  },
  setup() {
    const range = ref({
      start: null,
      end: null
    });

    function dateTimeFormatterIntlId(date) {
      const dateIntl = new Intl.DateTimeFormat('id-ID', { dateStyle: 'long', timeStyle: 'short' })
        .format(date);

      return dateIntl.replaceAll('.', ':');
    }

    const dateTimeFormatter = computed(() => {
      const start = dateTimeFormatterIntlId(range.value.start);
      const end = dateTimeFormatterIntlId(range.value.end);

      return {
        start,
        end
      }
    });

    return {
      range,
      dateTimeFormatter
    };
  },
  components: {
    DatePicker
  }
}
</script>

<style lang="scss" scoped>

  .date-picker__container {
    display: flex;
    align-items: center;
    border: 1px solid #ced4da;
    border-radius: 3px;

    .date-picker__field {
      position: relative;
      padding: 20px;
      height: 74px;


      display: flex;
      align-items: center;
      flex: 1;
      .icon {
        color: #2283B5;
        margin-right: .5rem;
        width: 20px;
        transform: scale(1.2);
      }
      &:first-child {
        padding-right: .5rem;
      }
      &:last-child {
        padding-left: 1.5rem;
        span {
          position: absolute;
          left: -.93rem;
          background-color: white;
          border: 1px solid #ced4da;
          height: 1.56rem;
          width: 1.56rem;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          color: #0064d2 !important;
          em.icon {
            width: .91rem;
            height: .91rem;
            position: relative;
            left: .29rem;

          }
        }
        border-left: 1px dashed #ced4da;
      }
      p {
        margin: 0;
        margin-top: .0625rem;
        font-size: .90rem;
        color: #8a93a7 !important;
        &.is-filled {
          color: #35405a !important;
          font-size: .85rem;
        }
      }
    }
  }
</style>
