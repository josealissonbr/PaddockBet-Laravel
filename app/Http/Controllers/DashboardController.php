<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Apostas;
use App\Models\Transacoes;
use App\Models\User;
use App\Models\Saques;
use App\Models\Depositos;

class DashboardController extends Controller
{
    public function index(){
        if (!Auth::Check()){
            if ( \App\Models\Eventos::where('situacao', 1)->limit(5)->count() < 1){
                return redirect(route('login'));
            }

            return view('pages.index');
        }
        return redirect('dashboard');
    }

    public function recalcSaldo(){

        $user = User::find(auth()->user()->id);

        $saldoUsuario = 0.00;

        $depositos = Depositos::where('situacao', 1)->where('idCliente', $user->id)->sum('valor');

        $apostas = Transacoes::where('idCliente', $user->id)->where('tipo', 2)->sum('valor');

        $saques = Saques::where('idCliente', $user->id)->whereIn('situacao', [0,1])->sum('valor');

        $recebApostas = Transacoes::where('idCliente', $user->id)->where('tipo', 4)->sum('valor');

        $saldoUsuario = $depositos - $apostas - $saques + $recebApostas;

        $user->saldo2 = $saldoUsuario;

        $user->save();

        return $user->saldo;
    }

    public function dashboard(){
        if (!Auth::Check()){
            return redirect('login');
        }

        $emApostas = 0.00;

        $apostas = Apostas::where('idCliente', auth()->user()->id)->get();

        foreach($apostas as $aposta){
            if ($aposta->resultado == 1)
                continue;

            if (!isset( $aposta->prova->situacao) || $aposta->prova->situacao == 1 || $aposta->prova->situacao == 2){
                $emApostas += $aposta->valorAposta;
            }

        }

        $emTransferencia = Transacoes::where('idCliente', auth()->user()->id)->where('tipo', 3)->where('situacao', 0)->sum('valor');

        $transacoes = Transacoes::where('idCliente', auth()->user()->id)->orderBy('idTransacao', 'desc')->paginate(10);

        return view('pages.dashboard', compact('emApostas', 'transacoes', 'emTransferencia'));
    }

    public function _dashboardValues(Request $request){
        $user = User::where('apikey', $request->input('apikey'))->get()->first();

    }

    public function editarPerfil(Request $request){
        return view('pages.editarPerfil');
    }

    public function _atualizarPerfil(Request $request){

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        $passwordOld = $request->input('passwordNo');

        if (!$user){
            return response()->json([
                'status'    =>  false,
                'msg'       => 'Falha ao autenticar.'
            ]);
        }

        if ($passwordOld){
            $user->password = Hash::make($passwordOld);
        }

        $user->save();

        return response()->json([
            'status'    =>  true,
            'msg'       => 'Alterações aplicadas com sucesso!'
        ]);

    }

    public function Saques(Request $request){
        $saques = Saques::where('idCliente', auth()->user()->id)->get();
        return view('pages.saques', compact('saques'));
    }

    public function novoSaque(){
        return view('pages.novoSaque');
    }

    public function _solicitarSaque(Request $request){
        $valorSaque = $request->input('valorSaque');
        //Converter comma "," em dot "."
        $valorSaque = str_replace(',','.', $valorSaque);

        if (!$valorSaque){
            return response()->json([
                'status' => false,
                'msg'       =>  'Parametros inválidos',
            ]);
        }

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        if(!$user){
            return response()->json([
                'status' => false,
                'msg'       =>  'Falha ao obter o usuário',
            ]);
        }

        if ($user->saldo < $valorSaque){
            return response()->json([
                'status' => false,
                'msg'       =>  'Saldo insuficiente',
            ]);
        }

        $transacao = new Transacoes;

        $transacao->tipo = 3;
        $transacao->idCliente = $user->id;
        $transacao->valor = $valorSaque;
        $transacao->situacao = 0;
        $transacao->save();

        $saque = new Saques;

        $saque->idCliente = $user->id;
        $saque->valor = $valorSaque;
        $saque->situacao = 0;
        $saque->idTransacao = $transacao->idTransacao;

        $status = $saque->save();

        //Recalcular Saldo
        \App\Helpers\mainHelper::recalcSaldo($user->id);

        if ($status){

            $user->decrement('saldo', $saque->valor);

            return response()->json([
                'status'    => true,
                'msg'       =>  'Saque solicitado com sucesso',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg'       =>  'Falha ao solicitar Saque',
            ]);
        }



    }

}
