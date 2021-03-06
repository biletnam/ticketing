let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/backend.js', 'public/js')
    .extract(['lodash', 'jquery', 'vue', 'foundation-sites', 'axios'])
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/backend.scss', 'public/css');

mix.copy('logo.png', 'public/images/logo.png');

if (mix.inProduction()) {
    mix.version();
}