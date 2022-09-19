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
    .js('resources/js/sidebar.js', 'public/js')
    .css('resources/css/sidebar.css', 'public/css')
    .css('resources/css/lookupScreens.css', 'public/css')
    .css('resources/css/ranksScreen.css', 'public/css')
    .css('resources/css/rolesScreen.css', 'public/css')
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/groupsScreen.css', 'public/css')
    .css('resources/css/userRolesScreen.css', 'public/css')
    .css('resources/css/navigationMenusScreen.css', 'public/css')
    .css('resources/css/navigationItemsScreen.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
mix.browserSync({ proxy: 'http://127.0.0.1' });