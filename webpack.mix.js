const mix = require('laravel-mix');
require('laravel-mix-purgecss');
const path = require("path");

mix.postCss("resources/css/app.css", "public/css/tailwind.css", [
    require("tailwindcss"),
]);
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    // .sass('resources/sass/master.scss', 'public/css/master.css')
/*    .purgeCss({
        enabled: mix.inProduction(),
        extend: {
            content: [
                path.join(__dirname, 'resources/views/!**!/!*.blade.php'),
                path.join(__dirname, 'resources/js/!**!/!*.vue'),
            ],
            whitelistPatterns: [/^v-/],
            whitelistPatternsChildren: [/^v-/],
            safelist: {
                standard: [
                    /-active$/,
                    /-enter$/,
                    /-leave-to$/,
                    /show$/,
                    /slick$/,
                ],
                deep: [
                    /^slick-/,
                    /^sorting_/,
                    /^sorting_/,
                    /^dataTable/,
                    /^dt-/,
                    /^modal-/,
                    /^offcanvas-/,
                    /^actvie/,
                    /^show/,
                    /^fade/,
                    /^collapse/,
                    /^collapsed/,
                    /^collapsing/,
                ],
            },
        }
    })*/

if (mix.inProduction()) {
    mix.version();
}

