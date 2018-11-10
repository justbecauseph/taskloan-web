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

Route::post('/users', 'UserController@store');

Route::middleware('auth.basic.once')->group(function () {
    Route::post('/me/documents', 'UserDocumentController@store');
    Route::post('/me/task', 'UserTaskController@store');
    Route::get('/tasks', 'TaskController@index');
    Route::post('/tasks', 'TaskController@store');
});
