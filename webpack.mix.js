const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css');
mix.js('resources/lib/app.js', 'public/js')
  .vue();

// webpack config for using pug engine on vue template.
mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.pug$/,
        loader: 'pug-plain-loader'
      }
    ]
  }
});
