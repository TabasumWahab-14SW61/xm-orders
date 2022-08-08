const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// COMPILING ALL JS
mix.scripts([
    'public/js/jquery-3.5.1.js',
    'public/js/jquery.dataTables.min.js',
    'public/js/dataTables.bootstrap4.min.js',
    'public/js/custom.js',
], 'public/js/all.js').version();


// COMPILING ALL CSS
mix.styles([
    'public/css/bootstrap.css',
    'public/css/dataTables.bootstrap4.min.css',
    'public/css/custom.css',
], 'public/css/all.css').version();