<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, UPDATE, OPTIONS');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function()
{

    Route::post('login', 'AuthController@login');
    Route::post('logout','AuthController@logout');
    Route::post('register', 'AuthController@register');

    Route::get('auth/{provider}', 'SocialiteAuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'SocialiteAuthController@handleProviderCallback');

    // Route::resource('posts', 'PostController');
    Route::get('posts', 'PostController@index');
    Route::get('posts/{id}', 'PostController@show');
    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::get('category', 'CategoryController@index');
    Route::resource('films', 'FilmController');


    Route::group(['middleware' => 'auth:api'], function(){
    	Route::post('details', 'AuthController@details');
      Route::post('userposts', 'UserController@userposts');
      Route::resource('users', 'UserController');
      Route::resource('posts', 'PostController', ['except' => ['index', 'show']]);
      Route::resource('products', 'ProductController', ['except' => ['index', 'show']]);
    });
});
