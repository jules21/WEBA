const mix = require('laravel-mix');
require('laravel-mix-purgecss');
const path = require("path");


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
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .purgeCss({
        enabled: mix.inProduction(),
        extend: {
            content: [
                path.join(__dirname, 'resources/views/**/*.blade.php'),
                path.join(__dirname, 'resources/js/**/*.vue'),
            ],
            whitelistPatterns: [/^v-/],
            whitelistPatternsChildren: [/^v-/],
            safelist: {standard: [/-active$/, /-enter$/, /-leave-to$/, /show$/]},
        }
    });
