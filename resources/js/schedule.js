import { createApp, computed, reactive, onErrorCaptured, defineComponent, onMounted, ref } from 'vue';

import { assign, merge, pick, omit, mapValues } from 'lodash';
import { DatePicker } from 'v-calendar';
import { Skeletor } from 'vue-skeletor';

import { format, Formatter } from '~/support/helpers/datetime-formatter';
import useFetch from '~/support/helpers/use-fetch';

import '~/bootstrap';

const component = defineComponent({
  components: {
    DatePicker,
    Skeletor
  },
  setup() {
    const rooms = reactive({
      data: [],
      isNotEmpty: computed(() => rooms.data.length > 0),
    });
    const isMounted = ref(false);
    const myformRef = ref(null);
    const form = reactive({
      room_id: null,
      title: '',
      desc: '',
      range: {
        start: new Date(),
        end: null,
      },
      employees: [],
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


    onMounted( async () => {
      // use fetch to fetching all of list rooms avaiable.
      try {
        const { data, status } = await useFetch('/api/rooms');
        if (data.payload.length > 0 && data.code === status) {
          // set initial room.
          form.room_id = data.payload[0]?.id;
          rooms.data = data.payload;
        }

      } catch (err) {
        // handle room error.
      }


      if (myformRef.value.dataset?.scheduleMethod === 'put') {
        // fetch schedule.
        try {
          const endpoint = route('async.schedules.show', myformRef.value.dataset?.scheduleId);
          const { data, status } = await useFetch(endpoint);
          if (data.code === status) {
            // pick list key in form.
            const pickKey = ['room_id', 'title', 'desc'];
            const body = merge( pick(data.payload, pickKey), {
              range: {
                start: new Date(data.payload?.started_at),
                end: new Date(data.payload?.ended_at),
              }
            });

            for (const key in body) {
              form[key] = body[key];
            }
          }
        } catch (err) {
          throw new Error(err ?? 'Error fetch schedule');
        }

      }


      isMounted.value = true;
    });



    function onSubmit() {
      const endpoint =  myformRef.value.getAttribute('action');
      const method = myformRef.value.dataset.scheduleMethod ?? 'post';


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

      axios[method](endpoint, body)
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
      myformRef, // ref to my form DOM.
      isMounted,
      roomSelected,
      scheduleFormatter
    }
  }
});

const app = createApp(component)

app.mount('#app');

