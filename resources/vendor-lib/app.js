import { createApp, defineAsyncComponent } from 'vue';


const app = createApp({});


app.component('room-schedule-form', defineAsyncComponent(() => import('~vendor/contents/room-schedule-form')));

app.component('datetime-picker-input', defineAsyncComponent(() => import('~vendor/components/datetime-picker-input')));

app.mount('#content'); // mount to app.

