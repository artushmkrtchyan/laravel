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
