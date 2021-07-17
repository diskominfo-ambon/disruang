<template lang="pug">
form-group.flex-1
  date-picker(
      v-model="range",
      mode="dateTime"
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
          i.fas.fa-calendar-week
          p(:class="range.start && 'is-filled'") {{ range.start ? dateIntlId.start : 'Mulai kapan?' }}
        .date-picker__field
          span
            i.fas.fa-exchange-alt

          i.fas.fa-calendar-day
          p(:class="range.end && 'is-filled'") {{ range.end ? dateIntlId.end : 'Sampai kapan?' }}

</template>
<script>
import { DatePicker } from 'v-calendar';
import { ref, computed } from 'vue';
import FormGroup from '~/components/atoms/form-group';


export default {
  setup() {
    const range = ref({
      start: null,
      end: null,
    });

    function dateTimeFormatterIntlId(date) {
      const dateIntl = new Intl.DateTimeFormat('id-ID', { dateStyle: 'long', timeStyle: 'short' })
        .format(date);

      return dateIntl.replaceAll('.', ':');
    }

    const dateIntlId = computed(() => {
      const start = dateTimeFormatterIntlId(range.value.start);
      const end = dateTimeFormatterIntlId(range.value.end);

      return {
        start,
        end
      }
    });

    return {
      range,
      dateIntlId
    };
  },
  components: {
    DatePicker,
    FormGroup
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
      padding: .8rem 1rem;
      display: flex;
      align-items: center;
      flex: 1;
      svg {
        color: #2283B5;
        margin-right: .5rem;
        width: 11px;
      }
      &:last-child {
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
          svg {
            width: .81rem;
            height: .81rem;
            position: relative;
            left: .25rem;
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
