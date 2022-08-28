<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apostas;
use App\Models\Eventos;
use App\Models\Provas;

class ApostasController extends Controller
{
    //
    public function index(){
        $apostas = Apostas::where('idCliente', auth()->user()->id)->with('prova')->get();
       // return $apostas;
        return view('pages.apostas', compact('apostas'));
    }

    public function palpite($idProva){
        $prova = Provas::find($idProva);
        //return $prova->conjuntos;
        return view('pages.palpite', compact('prova'));
    }

    public function provas($idEvento){
        $evento = Eventos::find($idEvento);
        $provas = Provas::where('idEvento', $idEvento)->get();
        //return $provas;
        return view('pages.provas', compact('evento','provas'));
    }
    public function eventos(){
        $eventos = Eventos::get();
        return view('pages.eventos', compact('eventos'));
    }
}
