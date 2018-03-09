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

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => 'admin', 'prefix' => 'admin','namespace' => 'Admin'], function(){

  Route::get('/', 'DashboardController@index')->name('dashboard');
  Route::get('users', 'UsersController@index')->name('users');
  Route::get('user/{id}', 'UsersController@show');
  Route::get('users/edit/{id}', 'UsersController@edit');
  Route::post('users/edit/{id}', ['uses' => 'UsersController@update', 'as' => 'users.edit']);
  Route::post('users/delete/{id}', ['uses' => 'UsersController@destroy', 'as' => 'users.delete']);

  Route::get('posts', 'PostController@index')->name('posts');
  Route::get('posts/create', 'PostController@createForm')->name('posts-create');
  Route::post('posts/create', ['uses' => 'PostController@create', 'as' => 'posts.create']);
  Route::get('post/{id}', ['uses' => 'PostController@show', 'as' => 'post.show']);
  Route::get('post/edit/{id}', ['uses' => 'PostController@edit']);
  Route::post('post/edit/{id}', ['uses' => 'PostController@update', 'as' => 'post.update']);
  Route::post('post/delete/{id}', ['uses' => 'PostController@destroy', 'as' => 'post.delete']);

  Route::get('category', 'CategoryController@index')->name('category');
  Route::get('category/create', 'CategoryController@createForm')->name('category-create');
  Route::post('category/create', ['uses' => 'CategoryController@create', 'as' => 'category.create']);
  Route::get('category/{id}', ['uses' => 'CategoryController@show', 'as' => 'category.show']);
  Route::get('category/edit/{id}', ['uses' => 'CategoryController@edit']);
  Route::post('category/edit/{id}', ['uses' => 'CategoryController@update', 'as' => 'category.update']);
  Route::post('category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.delete']);

  Route::get('shops', 'ShopsController@index')->name('shops');
  Route::get('shops/create', 'ShopsController@createForm')->name('shops-create');
  Route::post('shops/create', ['uses' => 'ShopsController@create', 'as' => 'shops.create']);
  Route::get('shops/{id}', ['uses' => 'ShopsController@show', 'as' => 'shops.show']);
  Route::get('shops/edit/{id}', ['uses' => 'ShopsController@edit']);
  Route::post('shops/edit/{id}', ['uses' => 'ShopsController@update', 'as' => 'shops.update']);
  Route::post('shops/delete/{id}', ['uses' => 'ShopsController@destroy', 'as' => 'shops.delete']);

  Route::get('product', 'ProductsController@index')->name('product');
  Route::get('product/create', 'ProductsController@createForm')->name('product-create');
  Route::post('product/create', ['uses' => 'ProductsController@create', 'as' => 'product.create']);
  Route::get('product/{id}', ['uses' => 'ProductsController@show', 'as' => 'product.show']);
  Route::get('product/edit/{id}', ['uses' => 'ProductsController@edit']);
  Route::post('product/edit/{id}', ['uses' => 'ProductsController@update', 'as' => 'product.update']);
  Route::post('product/delete/{id}', ['uses' => 'ProductsController@destroy', 'as' => 'product.delete']);

});
