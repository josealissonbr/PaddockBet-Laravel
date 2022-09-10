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

    Route::get('dashboard/depositos', 'App\Http\Controllers\DepositoController@historico')->name('dashboard.depositos.historico');


    Route::get('dashboard/perfil/editar', 'App\Http\Controllers\DashboardController@editarPerfil')->name('dashboard.perfil.editar');
});


Route::middleware(['Admin'])->group(function () {

    Route::get('admin', 'App\Http\Controllers\AdminController@home')->name('admin.home');
    Route::get('admin/eventos', 'App\Http\Controllers\AdminController@listaEventos')->name('admin.eventos');
    Route::get('admin/eventos/novo', 'App\Http\Controllers\AdminController@novoEvento')->name('admin.eventos.novo');
    Route::get('admin/eventos/editar/{idEvento}', 'App\Http\Controllers\AdminController@editarEvento')->name('admin.eventos.editar');
    Route::get('admin/provas', 'App\Http\Controllers\AdminController@listaProvas')->name('admin.provas');
    Route::get('admin/provas/novo', 'App\Http\Controllers\AdminController@novaProva')->name('admin.provas.novo');
    Route::get('admin/provas/editar/{idProva}', 'App\Http\Controllers\AdminController@editarProva')->name('admin.provas.editar');

    Route::get('admin/usuarios', 'App\Http\Controllers\AdminController@listaUsuarios')->name('admin.usuarios');
    Route::get('admin/usuarios/novo', 'App\Http\Controllers\AdminController@novoUsuario')->name('admin.usuarios.novo');

    Route::get('admin/transacoes', 'App\Http\Controllers\AdminController@listaTransacoes')->name('admin.transacoes');

});

Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('cadastro', 'App\Http\Controllers\AuthController@cadastro')->name('login.cadastro');

Route::post('login/process', 'App\Http\Controllers\AuthController@postLogin')->name('login.post');
Route::post('cadastro/process', 'App\Http\Controllers\AuthController@postRegistration')->name('login.cadastro.post');
Route::get('login/logout', 'App\Http\Controllers\AuthController@logout')->name('login.logout');
