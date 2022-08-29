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
Route::middleware(['authenticated'])->group(function () {
    Route::get('/', 'App\Http\Controllers\DashboardController@index');
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::get('dashboard/apostas', 'App\Http\Controllers\ApostasController@index')->name('dashboard.apostas');
    Route::get('dashboard/apostas/{idAposta}', 'App\Http\Controllers\ApostasController@detalhesBilhete')->name('dashboard.apostas.detalhes');
    Route::get('dashboard/eventos', 'App\Http\Controllers\ApostasController@eventos')->name('dashboard.eventos');
    Route::get('dashboard/provas/{idEvento}', 'App\Http\Controllers\ApostasController@provas')->name('dashboard.provas');
    Route::get('dashboard/provas/palpite/{idProva}', 'App\Http\Controllers\ApostasController@palpite')->name('dashboard.provas.palpite');
});

Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('cadastro', 'App\Http\Controllers\AuthController@cadastro')->name('login.cadastro');

Route::post('login/process', 'App\Http\Controllers\AuthController@postLogin')->name('login.post');
Route::get('login/logout', 'App\Http\Controllers\AuthController@logout')->name('login.logout');
