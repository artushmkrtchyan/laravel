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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function()
{
    // Route::resource('posts', 'Api\PostController');
    Route::post('login', 'API\UserController@login');
    Route::post('logout','API\UserController@logout');
    Route::post('register', 'API\UserController@register');

    Route::resource('products', 'Api\ProductController');
    Route::get('posts', 'Api\PostController@index');
    Route::get('posts/{id}', 'Api\PostController@show');

    Route::group(['middleware' => 'auth:api'], function(){
    	Route::post('details', 'API\UserController@details');
      Route::resource('posts', 'Api\PostController', ['except' => ['index', 'show']]);
    });
});
