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

mix.js('resources/js/socket-client.js', 'public/assets/js/socket-client.js')
    .js('resources/js/notification.js', 'public/assets/js/notification.js')
    .js('resources/js/message.js', 'public/assets/js/tcp.js');
