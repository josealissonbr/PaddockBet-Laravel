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

Route::get('/', 'App\Http\Controllers\DashboardController@index');
Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
Route::get('dashboard/apostas', 'App\Http\Controllers\ApostasController@index')->name('dashboard.apostas');



Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('cadastro', 'App\Http\Controllers\AuthController@cadastro')->name('login.cadastro');

Route::post('login/process', 'App\Http\Controllers\AuthController@postLogin')->name('login.post');
Route::get('login/logout', 'App\Http\Controllers\AuthController@logout')->name('login.logout');
