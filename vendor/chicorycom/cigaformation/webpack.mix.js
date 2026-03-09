const mix = require('laravel-mix');
const path = require('path');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.setPublicPath('./public');
mix
    .js('resources/admin/js/app.js', 'public/assets/js')
    .js('resources/admin/js/login.js', 'public/assets/js')
    .js('resources/public/js/theme.js', 'public/js')
    .js('resources/public/js/nav.js', 'public/students/js')
    .js('resources/public/js/auth.js', 'public/students/js')
    .sass('resources/admin/scss/main.scss', 'public/assets/css')
    .sass('resources/public/scss/style.scss', 'public/css')
    .sass('resources/public/student/main.scss', 'public/students/css')
    //.extract(['vue'])
    //.postCss('resources/public/css/app.css', 'public/css', [])


.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/admin/js')
        }
    },
});

if (mix.inProduction()) {
    mix
    // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
        .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
    //.versionHash()
} else {
    mix.sourceMaps()
}
