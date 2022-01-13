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
          <p>{{ placeholders[0] }}</p>
        </div>
        <div class="date-picker__field">
          <span>
            <em class="icon ni ni-swap"></em>
          </span>
          <em class="icon ni ni-calendar-check-fill"></em>
          <p>{{ placeholders[1] }}</p>
        </div>
      </div>
    </template>
   </date-picker>
  </div>
</template>

<script>
import { DatePicker } from 'v-calendar';

export default {
  name: 'DateRangeInput',
  props: [
    'placeholders',
  ],
  components: {
    DatePicker
  },
  computed: {
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