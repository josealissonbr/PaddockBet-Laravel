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

Route::get('dashboard', 'App\Http\Controllers\DashboardController@index');



Route::get('login', 'App\Http\Controllers\AuthController@index');
Route::post('login/process', 'App\Http\Controllers\AuthController@postLogin')->name('login.post');
