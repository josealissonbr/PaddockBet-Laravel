<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Apostas;
use App\Models\Transacoes;

class DashboardController extends Controller
{
    public function index(){
        if (!Auth::Check()){
            return redirect('login');
        }
        return redirect('dashboard');
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

            if ($aposta->prova->situacao == 1 || $aposta->prova->situacao == 2){
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

}
