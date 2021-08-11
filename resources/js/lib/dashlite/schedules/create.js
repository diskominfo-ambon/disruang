import { createApp, computed, reactive, onErrorCaptured, defineComponent } from 'vue';

import { DatePicker } from 'v-calendar';
import { omit, assign, mapValues } from 'lodash';

import { format, Formatter } from '~/support/helpers/datetime-formatter';
import useFetch from '~/support/helpers/use-fetch';

import '~/bootstrap';

const component = defineComponent({
  components: {
    DatePicker
  },
  setup() {
    const rooms = reactive({
      data: [],
      isNotEmpty: computed(() => rooms.data.length > 0),
    });

    const form = reactive({
      room_id: null,
      title: '',
      desc: '',
      range: {
        start: new Date(),
        end: null,
      },
      isSubmitting: false,
      errors: {
        data: {},
        message: '',
        hasErrorMessage: computed(() => form.errors.message.trim().length > 0),
      },
    });

    const roomSelected = computed(() => rooms.data.find(room => room.id === form.room_id));
    const scheduleFormatter = computed(() => {
      return {
        start: format(form.range.start)
          .toDate(Formatter.FULL)
          .value(),

        end: form.range.end
          ? format(form.range.end)
            .toDate(Formatter.FULL)
            .value()
          : 'Sampai kapan?'
      }
    });



    onErrorCaptured(() => {
      // error capture..
    });

    // use fetch to fetching all of list rooms avaiable.
    useFetch('/api/rooms')
      .then(res => {
        if (res.data.payload.length > 0) {
          // set initial room.
          form.room_id = res.data.payload[0]?.id;
          rooms.data = res.data.payload;
        }

      })
        .catch(err => {
          // handle error.
        });


    function onSubmit() {
      const endpoint = `/async/schedules`;

      // form fields.
      const body = assign(
        {
          started_at: form.range.start,
          ended_at: form.range.end
        },
        omit(form, ['errors', 'isSubmiting'])
      );

      // set initliaze form is submitted..
      form.isSubmitting = true;
      form.errors.data = [];
      form.errors.message = '';

      axios.post(endpoint, body)
        .then(({data, status}) => {
          if (data.code === status &&
            data.payload.ajax.reload
          ) {
            // reload browser.
            window.location.reload();
          }

          if (data.code === status &&
            !data.payload.ajax.reload && data.payload.ajax.route.trim().length > 0
          ) {
            // redirect to route path.
            window.location.replace(data.payload.ajax.route);
          }
        })
        .catch(({response}) => {
          // is validation error.
          if (response.status === 422 && Object.keys(response.data.errors).length > 0) {
            form.errors.data = mapValues(response.data.errors, value => value[0]);
          }

          if (response.status === 403 && !response.data.status) {
            form.errors.message = response.data.message;
          }

        }).finally(() => {
          form.isSubmitting = false;
        })
    }

    return {
      onSubmit,
      form,
      rooms,
      roomSelected,
      scheduleFormatter
    }
  }
});

createApp(component)
  .mount('#app');

