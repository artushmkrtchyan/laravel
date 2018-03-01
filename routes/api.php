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
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, UPDATE');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function()
{

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout','Api\AuthController@logout');
    Route::post('register', 'Api\AuthController@register');
    // Route::resource('posts', 'Api\PostController');
    Route::get('posts', 'Api\PostController@index');
    Route::get('posts/{id}', 'Api\PostController@show');

    Route::group(['middleware' => 'auth:api'], function(){
    	Route::post('details', 'Api\AuthController@details');
      Route::resource('users', 'Api\UserController');
      Route::resource('posts', 'Api\PostController', ['except' => ['index', 'show']]);
      Route::resource('products', 'Api\ProductController');
    });
});
