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
    Route::get('/me', 'UserController@show');
    Route::post('/me/documents', 'UserDocumentController@store');
    Route::post('/me/task', 'UserTaskController@store');
    Route::delete('/me/task', 'UserTaskController@destroy');
    Route::post('/me/task/status', 'TaskStatusController@store');
    Route::post('/me/wallet-amount', 'UserWalletAmountController@store');
    Route::get('/tasks', 'TaskController@index');
    Route::post('/tasks', 'TaskController@store');
    Route::post('/tasks/{task}/status', 'TaskStatusController@store');
});
