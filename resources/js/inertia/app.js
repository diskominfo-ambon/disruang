import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import '~/bootstrap';

import '@fortawesome/fontawesome-free/js/fontawesome.min.js';
import '@fortawesome/fontawesome-free/js/solid.min.js';
import '@fortawesome/fontawesome-free/js/regular.min.js';

createInertiaApp({
  resolve: name => import(/* webpackChunkName: "lib/[request]" */ `./pages/${name}`),
  setup({ el, app, props, plugin }) {
    const vue = createApp({ render: () => h(app, props) })
      .use(plugin);
    // before mount vue app, we resolve laravel named routes.
    vue.config.globalProperties.$route = (...args) => route(...args);

    // mount vue app.
    vue.mount(el);
  },
});

InertiaProgress.init();
