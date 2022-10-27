<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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

Route::middleware(['authenticated'])->group(function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::get('dashboard/apostas', 'App\Http\Controllers\ApostasController@index')->name('dashboard.apostas');
    Route::get('dashboard/apostas/{idAposta}', 'App\Http\Controllers\ApostasController@detalhesBilhete')->name('dashboard.apostas.detalhes');
    Route::get('dashboard/eventos', 'App\Http\Controllers\ApostasController@eventos')->name('dashboard.eventos');
    Route::get('dashboard/provas/{idEvento}', 'App\Http\Controllers\ApostasController@provas')->name('dashboard.provas');
    Route::get('dashboard/provas/palpite/{idProva}', 'App\Http\Controllers\ApostasController@palpite')->name('dashboard.provas.palpite');

    Route::get('dashboard/depositos', 'App\Http\Controllers\DepositoController@historico')->name('dashboard.depositos.historico');
    Route::get('dashboard/depositos/novo', 'App\Http\Controllers\DepositoController@novoDeposito')->name('dashboard.depositos.novo');
    Route::get('dashboard/depositos/pagar/{idDeposito}', 'App\Http\Controllers\DepositoController@pagarDeposito')->name('dashboard.depositos.pagar');
    Route::get('dashboard/saques', 'App\Http\Controllers\DashboardController@saques')->name('dashboard.saques');
    Route::get('dashboard/saques/novo', 'App\Http\Controllers\DashboardController@novoSaque')->name('dashboard.saques.novo');


    Route::get('dashboard/perfil/editar', 'App\Http\Controllers\DashboardController@editarPerfil')->name('dashboard.perfil.editar');
});

Route::get('hashmake', function(Request $request){
    return Hash::make($request->input('string'));
});

Route::middleware(['Admin'])->group(function () {

    Route::get('admin', 'App\Http\Controllers\AdminController@home')->name('admin.home');
    Route::get('admin/eventos', 'App\Http\Controllers\AdminController@listaEventos')->name('admin.eventos');
    Route::get('admin/eventos/novo', 'App\Http\Controllers\AdminController@novoEvento')->name('admin.eventos.novo');
    Route::get('admin/eventos/editar/{idEvento}', 'App\Http\Controllers\AdminController@editarEvento')->name('admin.eventos.editar');
    Route::get('admin/eventos/provas/{idEvento}', 'App\Http\Controllers\AdminController@provasEvento')->name('admin.eventos.provas');
    Route::get('admin/provas', 'App\Http\Controllers\AdminController@listaProvas')->name('admin.provas');
    Route::get('admin/provas/novo', 'App\Http\Controllers\AdminController@novaProva')->name('admin.provas.novo');
    Route::get('admin/provas/editar/{idProva}', 'App\Http\Controllers\AdminController@editarProva')->name('admin.provas.editar');

    Route::get('admin/usuarios', 'App\Http\Controllers\AdminController@listaUsuarios')->name('admin.usuarios');
    Route::get('admin/usuarios/editar/{idUser}', 'App\Http\Controllers\AdminController@editUsuarios')->name('admin.usuarios.edit');
    Route::get('admin/usuarios/novo', 'App\Http\Controllers\AdminController@novoUsuario')->name('admin.usuarios.novo');

    Route::get('admin/transacoes', 'App\Http\Controllers\AdminController@listaTransacoes')->name('admin.transacoes');
    Route::get('admin/saques/pendentes', 'App\Http\Controllers\AdminController@listaSaquesPendentes')->name('admin.saques.pendentes');

    Route::get('admin/depositos', 'App\Http\Controllers\AdminController@listaDepositos')->name('admin.depositos');
    Route::get('admin/depositos/completos', 'App\Http\Controllers\AdminController@listaDepositosCompletos')->name('admin.depositos.completos');

});

Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('cadastro', 'App\Http\Controllers\AuthController@cadastro')->name('login.cadastro');
Route::get('redefinir-senha', 'App\Http\Controllers\AuthController@redefinirSenha')->name('login.reset-password');

Route::post('login/process', 'App\Http\Controllers\AuthController@postLogin')->name('login.post');
Route::post('redefinir-senha/process', 'App\Http\Controllers\AuthController@postRedefinirSenha')->name('login.redefinir-senha.post');

Route::get('redefinir-senha/update/{token}', 'App\Http\Controllers\AuthController@RedefinirSenhaToken')->name('login.redefinir-senha.changepw.get');

Route::post('redefinir-senha/updateByToken', 'App\Http\Controllers\AuthController@postRedefinirSenhaToken')->name('login.redefinir-senha.changepw.post');

Route::post('cadastro/process', 'App\Http\Controllers\AuthController@postRegistration')->name('login.cadastro.post');
Route::get('login/logout', 'App\Http\Controllers\AuthController@logout')->name('login.logout');

Route::get('sendtxtmail','App\Http\Controllers\MailController@txt_mail');
Route::get('sendhtmlmail','App\Http\Controllers\MailController@html_mail');
Route::get('sendattachedemail','App\Http\Controllers\MailController@attached_email');
