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

        $transacoes = Transacoes::where('idCliente', auth()->user()->id)->orderBy('idTransacao', 'desc')->limit(5)->get();

        return view('pages.dashboard', compact('emApostas', 'transacoes'));
    }

    public function _dashboardValues(Request $request){

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

    }
}
