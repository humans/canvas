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

mix.webpackConfig({
        resolve: {
            alias: {
                '@components': path.resolve(__dirname, 'resources/assets/js/components'),
            },
        },
    })
    .postCss('resources/assets/css/app.css', 'public/css', [
        require('postcss-import'),
        require('postcss-nested'),
        require('tailwindcss')('./resources/assets/tailwind.js'),
    ])
    .js('resources/assets/js/register.js', 'public/js')
    .js('resources/assets/js/app.js', 'public/js')

if (['development', 'production'].includes(process.env.NODE_ENV)) {
    mix.extract(['vue', 'axios']).version()
}
