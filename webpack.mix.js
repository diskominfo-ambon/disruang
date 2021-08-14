const mix = require('laravel-mix');


mix.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/inertia/app.js', 'public/js')
  .js('resources/js/lib/dashlite/schedule.js', 'public/js/vendor/dashlite')
  .vue();



// webpack config for using pug engine on vue template.
mix.webpackConfig({
  resolve: {
    alias: {
      '~': `${__dirname}/resources/js`,
      '~inertia': `${__dirname}/resources/js/inertia`,
      '~lib': `${__dirname}/resources/js/lib`
    }
  }
});


if (mix.inProduction()) {
  mix.version();
}
