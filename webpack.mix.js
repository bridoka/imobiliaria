let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.autoload({
    jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
});

mix.scripts([
    'vendor/bower_components/bootstrap-validator/dist/validator.js',
    'vendor/bower_components/jquery-mask-library/lib/mask.js',
    'vendor/bower_components/jquery-maskmoney/dist/jquery.maskMoney.js',
    'public/js/util.js',
    'public/js/loadbox.js'
], 'public/js/sistema.js');
