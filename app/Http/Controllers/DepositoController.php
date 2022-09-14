<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;
use App\Models\Depositos;
use App\Models\User;

class DepositoController extends Controller
{
    public function historico(Request $request){

        $depositos = Depositos::where('idCliente', auth()->user()->id)->paginate(1);
        //return $transacoes;
        return view('pages.depositos', compact('depositos'));
    }

    public function novoDeposito(Request $request){
        return view('pages.novoDeposito');
    }

    public function _novoDeposito(Request $request){

        $user = User::where('apikey', $request->input('apikey'))->get()->first();
        if (!$user){
            return response()->json([
                'status' => false,
                'msg' => 'Usuário não autenticado'
            ]);
        }

        $valorDeposito = $request->input('valorDeposito');

        $valorDeposito = str_replace(',', '.', $valorDeposito);
        $valorDeposito = bcadd($valorDeposito   ,'0',2);

        if (!$valorDeposito){
            return response()->json([
                'status' => false,
                'msg' => 'Valor para depósito inválido'
            ]);
        }

        if ($valorDeposito < 20.00){
            return response()->json([
                'status' => false,
                'msg' => 'Valor mínimo para depósito é de R$20,00'
            ]);
        }

        /*if ($user->saldo < $valorDeposito){
            return response()->json([
                'status' => false,
                'msg' => 'Saldo insuficiente'
            ]);
        }*/

        $transacao = new Transacoes;

        $transacao->tipo = 1;
        $transacao->idCliente = $user->id;
        $transacao->valor = $valorDeposito;
        $transacao->situacao = 0;

        $status = $transacao->save();

        if (!$status){
            return response()->json([
                'status' => false,
                'msg' => 'Falha ao criar transacao',
            ]);
        }

        $deposito = new Depositos;

        $deposito->idTransacao = $transacao->idTransacao;
        $deposito->idCliente = $user->id;
        $deposito->valor = $valorDeposito;
        $deposito->situacao = 0;

        $status = $deposito->save();

        if (!$status){
            $transacao->situacao = 2;
            $transacao->save();
            return response()->json([
                'status' => false,
                'msg' => 'Falha ao criar depósito',
            ]);
        }

        return response()->json([
            'status'        => true,
            'idTransacao'   => $transacao->idTransacao,
            'idDeposito'    =>  $deposito->id,
        ]);
    }
}
