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

Route::post('provas/palpites/efetuar', 'App\Http\Controllers\ApostasController@_EfetuarPalpite')->name('api.provas.fazerPalpite');
Route::post('dashboard/home', 'App\Http\Controllers\DashboardController@_dashboardValues')->name('api.dashboard.home');


Route::middleware(['AdminApi'])->group(function () {
    Route::post('admin/eventos/_novo', 'App\Http\Controllers\AdminController@_addEvento')->name('api.admin.eventos.novo');
    Route::post('admin/provas/_novo', 'App\Http\Controllers\AdminController@_addProva')->name('api.admin.provas.novo');
});


//Editar perfil
Route::post('user/atualizarPerfil', 'App\Http\Controllers\DashboardController@_atualizarPerfil')->name('api.perfil.atualizarPerfil');
