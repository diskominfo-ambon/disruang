const mix = require('laravel-mix');


mix.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/lib/app.js', 'public/js')
  .vue();

// webpack config for using pug engine on vue template.
mix.webpackConfig({
  resolve: {
    alias: {
      '~': `${__dirname}/resources/lib`
    }
  },
  module: {
    rules: [
      {
        test: /\.pug$/,
        loader: 'pug-plain-loader'
      }
    ]
  }
});


if (mix.inProduction()) {
  mix.version();
}
