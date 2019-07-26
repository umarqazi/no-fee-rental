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

mix.js([
	'resources/js/login.js',
	'resources/js/common.js',
	'resources/js/map.js',
	'resources/js/admin/user.js',
	'resources/js/admin/company.js',
	], 'public/assets/js/app.js');
