<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{x?}', function ($x ='there') {
    return view('welcome',compact('x'));
});

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');