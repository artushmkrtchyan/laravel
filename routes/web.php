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

Route::resource('post', 'PostController', ['names' =>['index' => 'post.index', 'show' => 'post.show']]);

Route::resource('film', 'FilmController', ['names' =>['index' => 'views.film.index', 'show' => 'views.film.show']]);

Route::group(['middleware' => 'admin', 'prefix' => 'admin','namespace' => 'Admin'], function(){

  Route::get('/', 'DashboardController@index')->name('dashboard');
  Route::get('users', 'UsersController@index')->name('users');
  Route::get('user/{id}', 'UsersController@show');
  Route::get('users/edit/{id}', 'UsersController@edit');
  Route::post('users/edit/{id}', ['uses' => 'UsersController@update', 'as' => 'users.edit']);
  Route::post('users/delete/{id}', ['uses' => 'UsersController@destroy', 'as' => 'users.delete']);

  Route::get('posts', 'PostController@index')->name('admin.posts');
  Route::get('posts/create', 'PostController@create')->name('admin.posts.create');
  Route::post('posts/create', ['uses' => 'PostController@store', 'as' => 'admin.posts.store']);
  Route::get('posts/{id}', ['uses' => 'PostController@show', 'as' => 'admin.post.show']);
  Route::get('posts/edit/{id}', 'PostController@edit')->name('admin.post.edit');
  Route::post('posts/edit/{id}', ['uses' => 'PostController@update', 'as' => 'admin.post.update']);
  Route::post('posts/delete/{id}', ['uses' => 'PostController@destroy', 'as' => 'admin.post.delete']);

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

  Route::resource('genre', 'GenreController');

  Route::resource('film', 'FilmController');

  Route::resource('actor', 'ActorController');

});
