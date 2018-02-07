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

Auth::routes();
Route::get('home', 'HomeController@index')->name('home');
Route::get('account', 'ProfileController@index')->name('account');
Route::get('admin', 'Admin\DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
  Route::get('users', 'UsersController@index')->name('users');
  Route::get('user/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@show']);
  Route::get('users/edit/{id}', ['middleware' => 'auth', 'uses' => 'UsersController@edit']);
  Route::post('users/edit/{id}', ['uses' => 'UsersController@update', 'as' => 'users.edit']);
  Route::post('users/delete/{id}', ['uses' => 'UsersController@destroy', 'as' => 'users.delete']);
  Route::get('posts', 'PostController@index')->name('posts');
  Route::get('posts/create', 'PostController@createForm')->name('posts-create');
  Route::post('posts/create', ['uses' => 'PostController@create', 'as' => 'posts.create']);
  Route::get('post/{id}', ['middleware' => 'auth', 'uses' => 'PostController@show', 'as' => 'post.show']);
  Route::get('post/edit/{id}', ['middleware' => 'auth', 'uses' => 'PostController@edit']);
  Route::post('post/edit/{id}', ['uses' => 'PostController@update', 'as' => 'post.update']);
  Route::post('post/delete/{id}', ['uses' => 'postController@destroy', 'as' => 'post.delete']);
  Route::get('category', 'CategoryController@index')->name('category');
  Route::get('category/create', 'CategoryController@createForm')->name('category-create');
  Route::post('category/create', ['uses' => 'CategoryController@create', 'as' => 'category.create']);
  Route::get('category/{id}', ['middleware' => 'auth', 'uses' => 'CategoryController@show', 'as' => 'category.show']);
  Route::get('category/edit/{id}', ['middleware' => 'auth', 'uses' => 'CategoryController@edit']);
  Route::post('category/edit/{id}', ['uses' => 'CategoryController@update', 'as' => 'category.update']);
  Route::post('category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.delete']);
});
