const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')

   .scripts('node_modules/jquery/dist/jquery.js' , 'public/ajax/jquery.js')
   
   .scripts('node_modules/form-master/dist/jquery.form.min.js', 'public/ajax/form/jquery.js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/modify.scss','public/style/modify.css')
   .scripts('resources/js/menu.js', 'public/menu/menu.js');
