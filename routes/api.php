<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api'], function(){

    // Routes for all form of Authentication
    Route::group([
        'namespace' => 'Auth',
        'prefix' => 'auth'
    
    ], function ($router) {
    
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');
        Route::post('logout', 'LoginController@logout');
        Route::post('refresh', 'LoginController@refresh');
        Route::post('user', 'LoginController@me');
    
    });

    Route::group([
        'middleware' => 'auth',
        'prefix' => 'conversations'
    ], function() {
        Route::get('', 'ConversationController@index');
        Route::get('{id?}', 'ConversationController@show');
        Route::post('create', 'ConversationController@store');
        Route::patch('update', 'ConversationController@update');
        Route::delete('remove', 'ConversationController@destroy');
    });

    Route::group([
        'prefix' => 'messages'
    ], function() {
        Route::get('', 'MessageController@index');
        Route::get('{id?}', 'MessageController@show');
        Route::post('create', 'MessageController@store');
        Route::patch('update', 'MessageController@update');
        Route::delete('remove', 'MessageController@destroy');
    });

});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });