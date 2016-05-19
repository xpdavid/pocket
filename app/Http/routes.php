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

Route::get('admin/pocket/search', 'PocketController@getSearch');
Route::post('admin/pocket/search', 'PocketController@postSearch');
Route::resource('admin/pocket', 'PocketController');
Route::controller('admin/pocket-upload', 'PocketFileController');

Route::controller('admin', 'AdminController');

Route::controller('api', 'APIController');

