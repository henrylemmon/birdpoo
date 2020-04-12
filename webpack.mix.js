let mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js')
    .tailwind('./tailwind.config.js')
    .sass('resources/sass/app.scss', 'public/css');
