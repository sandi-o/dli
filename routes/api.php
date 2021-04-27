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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::get('/categories','CategoryController@index');
Route::post('/categories', 'CategoryController@store');
Route::get('/categories/{category}', 'CategoryController@show');
Route::patch('/categories/{category}', 'CategoryController@update');
Route::delete('/categories/{category}', 'CategoryController@destroy');

Route::get('/tasks/{category}','TaskController@index');
Route::post('/tasks/{category}', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::patch('/tasks/{task}', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');

Route::get('/todos','TodoController@index');
Route::post('/todos/search', 'TodoController@search');