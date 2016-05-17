<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pocket.index');
});


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/admin/add', function () {
    return view('admin.add');
});

Route::get('/admin/tag', function () {
    return view('admin.tag');
});
