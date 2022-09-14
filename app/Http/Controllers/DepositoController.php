<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;

class DepositoController extends Controller
{
    public function historico(Request $request){

        $transacoes = Transacoes::where('idCliente', auth()->user()->id)->where('tipo', 1)->paginate(20);
        //return $transacoes;
        return view('pages.depositos', compact('transacoes'));
    }

    public function novoDeposito(Request $request){
        return view('pages.novoDeposito');
    }
}
