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
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/moment/moment.js',
    'node_modules/dropzone/dist/dropzone.js',
    'node_modules/datatables.net/js/jquery.dataTables.js',
    'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
    'resources/js/aluno.js',
    'resources/js/curso.js',
    'resources/js/app.js'], 'public/js/app.js')
    .autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"],
        dropzone: ['Dropzone'],
        moment: ['moment'],
    })
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
