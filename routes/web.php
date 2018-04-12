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
Route::post('register', 'Auth\RegisterController@create')->name('register');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::resource('contact-us', 'ContactUSController', ['names' =>['index' => 'contact.index', 'store' => 'contact.store']]);

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

  Route::resource('product', 'ProductsController', ['names' =>[
      'index' => 'admin.product.index',
      'create' => 'admin.product.create',
      'store' => 'admin.product.store',
      'edit' => 'admin.product.edit',
      'update' => 'admin.product.update',
      'show' => 'admin.product.show',
      'destroy' => 'admin.product.destroy'
     ]
   ]
 );

  Route::resource('category', 'CategoryController');

  Route::resource('shops', 'ShopsController');

  Route::resource('contact-us', 'ContactUSController', ['names' =>['index' => 'admin.contact.index', 'destroy' => 'admin.contact.destroy']]);

});
