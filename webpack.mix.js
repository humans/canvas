let tailwind = require('tailwindcss')
let { mix }  = require('laravel-mix')

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

mix.sass('resources/assets/sass/app.scss', 'public/css')
   .options({
       postCss: [
           tailwind('./resources/assets/tailwind.js')
       ]
    })
   .js('resources/assets/js/register.js', 'public/js')
   .js('resources/assets/js/app.js', 'public/js')
   .extract(['vue', 'axios'])

   // I'm not sure why notifications are crashing the daemon.
   .disableNotifications()
