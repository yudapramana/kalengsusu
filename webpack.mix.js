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


    .js('public/landing/js/jquery-1.12.4.min.js', 'public/js')
    .js('public/landing/js/jquery-ui.js', 'public/js')
    .js('public/landing/js/popper.min.js', 'public/js')
    .js('public/landing/bootstrap/js/bootstrap.min.js', 'public/js')
    .js('public/landing/owlcarousel/js/owl.carousel.min.js', 'public/js')
    .js('public/landing/js/magnific-popup.min.js', 'public/js')
    .js('public/landing/js/waypoints.min.js', 'public/js')
    .js('public/landing/js/parallax.js', 'public/js')
    .js('public/landing/js/jquery.countdown.min.js', 'public/js')
    .js('public/landing/js/jquery.fitvids.js', 'public/js')
    .js('public/landing/js/jquery.counterup.min.js', 'public/js')
    .js('public/landing/js/isotope.min.js', 'public/js')
    .js('public/landing/js/jquery.elevatezoom.js', 'public/js')
    .js('public/landing/js/jquery.dd.min.js', 'public/js')
    .js('public/landing/js/datepicker.min.js', 'public/js')
    .js('public/landing/js/mdtimepicker.min.js', 'public/js')
    .js('public/demo-assets/js/demo-medical.js', 'public/js')
    .js('public/landing/js/scripts.js', 'public/js')



    .sass('resources/sass/app.scss', 'public/css');
// .sourceMaps();


// 'public/landing/js/jquery-1.12.4.min.js',
// 'public/landing/js/jquery-ui.js',
// 'public/landing/js/popper.min.js',
// 'public/landing/bootstrap/js/bootstrap.min.js',
// 'public/landing/owlcarousel/js/owl.carousel.min.js',
// 'public/landing/js/magnific-popup.min.js',


// 'public/landing/js/jquery-1.12.4.min.js',
// 'public/landing/js/jquery-ui.js',
// 'public/landing/js/popper.min.js',
// 'public/landing/bootstrap/js/bootstrap.min.js',

mix.combine([
    'public/landing/js/jquery-1.12.4.min.js',
    'public/landing/js/jquery-ui.js',
    'public/landing/js/popper.min.js',
    'public/landing/bootstrap/js/bootstrap.min.js',
    'public/landing/owlcarousel/js/owl.carousel.min.js',
    'public/landing/js/magnific-popup.min.js',
    'public/landing/js/waypoints.min.js',
    'public/landing/js/parallax.js',
    'public/landing/js/jquery.countdown.min.js',
    'public/landing/js/jquery.fitvids.js',
    'public/landing/js/jquery.counterup.min.js',

    'public/landing/js/isotope.min.js',
    'public/landing/js/jquery.elevatezoom.js',
    'public/landing/js/jquery.dd.min.js',
    'public/landing/js/datepicker.min.js',
    'public/landing/js/mdtimepicker.min.js',
    'public/demo-assets/js/demo-medical.js',
    'public/landing/js/scripts.js',
], 'public/js/combined.js');

// mix.autoload({ jquery: ['$', 'window.jQuery'] });