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

Route::get('/', function () {
    return view('index');
});

Route::get('/users', 'UsersController@index')->name('users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'ProfileController@index')->name('account');

Route::get('/user/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@show'
]);

Route::get('/users/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@edit'
]);

Route::post('/users/edit/{id}', [
    'uses' => 'UsersController@update',
    'as' => 'users.edit'
]);

Route::post('/users/delete/{id}', [
    'uses' => 'UsersController@destroy',
    'as' => 'users.delete'
]);

//Route::resource('posts', 'PostController');

Route::get('/posts', 'PostController@index')->name('posts');

//Route::post('/posts/create', 'PostController@create')->name('posts.create');
Route::get('/posts/create', 'PostController@createForm');

Route::post('/posts/create', [
    'uses' => 'PostController@create',
    'as' => 'posts.create'
]);

Route::get('/post/{id}', [
    'middleware' => 'auth',
    'uses' => 'PostController@show'
]);

Route::get('/post/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'PostController@edit'
]);

Route::post('/post/edit/{id}', [
    'uses' => 'PostController@update',
    'as' => 'post.update'
]);

Route::post('/post/delete/{id}', [
    'uses' => 'postController@destroy',
    'as' => 'post.delete'
]);
