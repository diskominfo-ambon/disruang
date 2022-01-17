<template>
  <div>
   <date-picker
      v-model="localvalue"
      mode="dateTime"
      :columns="2"
      :locale="{ id: 'id', firstDayOfWeek: 3, masks: { weekdays: 'WWW', input: ['DD-MM-YY'] } }"
      is-range
      is-expanded
      is24hr
    >
    <template v-slot="{ inputEvents }">
      <div class="date-picker__container" v-on="inputEvents.start">
        <div class="date-picker__field">
          <em class="icon ni ni-calendar-fill"></em>
          <p>{{ date.start }}</p>
        </div>
        <div class="date-picker__field">
          <span>
            <em class="icon ni ni-swap"></em>
          </span>
          <em class="icon ni ni-calendar-check-fill"></em>
          <p>{{ date.end }}</p>
        </div>
      </div>
    </template>
   </date-picker>
  </div>
</template>

<script>
import { DatePicker } from 'v-calendar';


function diffForHumans(date) {
 
  return new Intl.DateTimeFormat('id-ID', { dateStyle: 'long', timeStyle: 'short' })
    .format(date);
}

export default {
  name: 'DateRangeInput',
  props: [
    'placeholders',
    'value',
  ],
  components: {
    DatePicker
  },
  computed: {
    date() {
      const value = this.localvalue;
      const start = value.start != null
        ? diffForHumans(value.start)
        : this.placeholders[0]; 

      const end = value.end != null
        ? diffForHumans(value.end)
        : this.placeholders[1]; 

      return { start, end };
    },
    localvalue: {
      set(value) {
        this.$emit('input', value);
      },
      get() {
        return this.value;
      }
    }
  }
}
</script>