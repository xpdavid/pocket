var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // for client side
    mix.styles([
        'bootstrap.min.css',
        'sweetalert.css',
        'timeline.css',
        'main.css',
    ]);

    mix.scripts([
        'jquery-2.2.3.min.js',
        'bootstrap.min.js',
        'main.js',
    ]);

    // for admin side

    mix.styles([
        'bootstrap-datetimepicker.min.css',
        'select2.min.css',
        'admin/main.css'
    ], 'public/css/admin_all.css');

    mix.scripts([
        'bootstrap-datetimepicker.zh-CN.js',
        'bootstrap-datetimepicker.min.js',
        'select2.full.min.js',
        'zh-CN.js',
        'admin/main.js',
    ], 'public/js/admin_all.js');

});
