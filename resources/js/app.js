import { createApp } from 'vue';

import '~/bootstrap';

import '@fortawesome/fontawesome-free/js/fontawesome.min.js';
import '@fortawesome/fontawesome-free/js/solid.min.js';
import '@fortawesome/fontawesome-free/js/regular.min.js';

import ScheduleForm from '~/components/ScheduleForm';

createApp({
    components: {
        ScheduleForm
    }
}).mount('#app');