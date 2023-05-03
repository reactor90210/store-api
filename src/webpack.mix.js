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

mix.webpackConfig({
    stats: {
        children: true,
    },});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/admin-lte/dist/img', 'public/dist/img')
    .copy('resources/js/demo.js', 'public/js/demo.js')
    .copy('resources/js/dashboard2.js', 'public/js/dashboard2.js')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts')
    .copy('node_modules/admin-lte/plugins/chart.js/Chart.js', 'public/js/chart.js')

    .copy('node_modules/admin-lte/plugins/raphael/raphael.js', 'public/js/raphael.js')
    .copy('node_modules/admin-lte/plugins/jquery-mapael/jquery.mapael.js', 'public/js/jquery.mapael.js')
    .copy('node_modules/admin-lte/plugins/jquery-mapael/maps/usa_states.js', 'public/js/usa_states.js')
    .copy('node_modules/admin-lte/plugins/chart.js/Chart.css', 'public/css/Chart.css')
    .copy('node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js')
    .copy('node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'public/css/icheck-bootstrap.min.css')
    .sourceMaps();
