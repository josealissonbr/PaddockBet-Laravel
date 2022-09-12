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
    Route::post('admin/eventos/_editar', 'App\Http\Controllers\AdminController@_editEvento')->name('api.admin.eventos.editar');
    Route::post('admin/eventos/_excluir', 'App\Http\Controllers\AdminController@_deleteEvento')->name('api.admin.eventos.excluir');
    Route::post('admin/provas/_novo', 'App\Http\Controllers\AdminController@_addProva')->name('api.admin.provas.novo');
    Route::post('admin/provas/_editar', 'App\Http\Controllers\AdminController@_editProva')->name('api.admin.provas.editar');
    Route::post('admin/provas/_excluir', 'App\Http\Controllers\AdminController@_deleteProva')->name('api.admin.provas.excluir');
    Route::post('admin/provas/_definirVencedorProva', 'App\Http\Controllers\AdminController@_definirVencedorProva')->name('api.admin.provas.definirvencedor');

    Route::post('admin/usuario/_novo', 'App\Http\Controllers\AdminController@_addUsuario')->name('api.admin.usuarios.novo');

    Route::post('admin/saques/_cancelar', 'App\Http\Controllers\AdminController@_cancelarSaque')->name('api.admin.saques.cancelar');
    Route::post('admin/saques/_aprovar', 'App\Http\Controllers\AdminController@_aprovarSaque')->name('api.admin.saques.aprovar');
});


//Editar perfil
Route::post('user/atualizarPerfil', 'App\Http\Controllers\DashboardController@_atualizarPerfil')->name('api.perfil.atualizarPerfil');
