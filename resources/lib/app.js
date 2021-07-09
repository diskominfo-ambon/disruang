import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import axios from 'axios';

import './bootstrap';

createInertiaApp({
  resolve: name => import(`./views/${name}`),
  setup({ el, app, props, plugin }) {
    const vue = createApp({ render: () => h(app, props) })
      .use(plugin);

    vue.config.globalProperties.$axios = axios.create({
      baseURL: process.env.APP_URL,
    });
    // before mount vue app, we resolve laravel named routes.
    vue.config.globalProperties.$route = (...args) => route(...args);

    // mount vue app.
    vue.mount(el);
  },
});

InertiaProgress.init();
