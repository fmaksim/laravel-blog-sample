<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Blog\HomeController@index');

Route::group([
    "namespace" => "Admin",
    "prefix" => "admin"
], function() {
    Route::get('/', 'DashboardController@index');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
});