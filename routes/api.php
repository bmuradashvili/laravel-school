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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\AuthController@login');

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::post('logout', 'Api\AuthController@logout');
        Route::post('refresh', 'Api\AuthController@refresh');
        Route::post('user', 'Api\AuthController@user');
    });
});

Route::group(['middleware' => 'jwt.auth'], function() {
    Route::resource('directors', 'Api\DirectorController')->only([
        'index'
    ]);
    Route::resource('teachers', 'Api\TeacherController')->only([
        'index'
    ]);

    Route::resource('messages', 'Api\MessageController')->only([
        'store'
    ]);
    Route::resource('comments', 'Api\CommentController')->only([
        'store'
    ]);
});
