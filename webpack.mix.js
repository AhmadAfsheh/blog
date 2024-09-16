const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/post-form.js', 'public/js')
   .css('resources/css/app.css', 'public/css')
   .version();
