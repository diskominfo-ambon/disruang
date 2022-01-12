const mix = require('laravel-mix');


mix.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/app.js', 'public/js')
  .vue();



// webpack config for using pug engine on vue template.
mix.webpackConfig({
  resolve: {
    alias: {
      '~': `${__dirname}/resources/js`,
    }
  }
});


if (mix.inProduction()) {
  mix.version();
}
