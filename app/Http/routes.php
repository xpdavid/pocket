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

Route::resource('admin/location', 'LocationController');
Route::resource('admin/type', 'TypeController');
Route::resource('admin/organization', 'OrganizationController');
Route::resource('admin/tag', 'TagController');

Route::controller('api', 'APIController');

