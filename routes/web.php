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

Route::get('/', 'Blog\HomeController@index')->name('home');
Route::get('/post/{slug}', 'Blog\PostController@show')->name('post.show');
Route::get('/category/{slug}', 'Blog\CategoryController@show')->name('category.show');
Route::get('/tag/{slug}', 'Blog\TagController@show')->name('tag.show');

Route::group([
    "middleware" => "guest"
], function () {
    Route::get('/register', 'Blog\AuthController@registerForm')->name('register.form');
    Route::post('/register', 'Blog\AuthController@register')->name('register');

    Route::get('/login', 'Blog\AuthController@loginForm')->name('login');
    Route::post('/login', 'Blog\AuthController@login')->name('login');
});

Route::group([
    "middleware" => "auth"
], function () {
    Route::post('/logout', 'Blog\AuthController@logout')->name('logout');
    Route::get('/profile', 'Blog\ProfileController@index')->name('profile');
    Route::post('/profile', 'Blog\ProfileController@update')->name('profile.update');
    Route::post('/comment', 'Blog\CommentController@store')->name('comment.store');
});

Route::group([
    "namespace" => "Admin",
    "prefix" => "admin",
    "middleware" => "admin"
], function() {
    Route::get('/', 'DashboardController@index');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
});