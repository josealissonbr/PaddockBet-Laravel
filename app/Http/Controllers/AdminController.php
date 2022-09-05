<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Provas;

class AdminController extends Controller
{
    public function home(Request $request){
        return view('admin.pages.home');
    }

    public function listaEventos(Request $request){
        $eventos = Eventos::all();
        return view('admin.pages.eventos.listaEventos', compact('eventos'));
    }

    public function novoEvento(Request $request){
        return view('admin.pages.eventos.novoEvento');
    }

    public function listaProvas(Request $request){
        $provas = Provas::all();
        return view('admin.pages.provas.listaProvas', compact('provas'));
    }


    public function _addEvento(Request $request){
        $strNomeEvento = $request->input('nomeEvento');
        $strCidade = $request->input('nomeCidade');
        $iSituacao = $request->input('Situacao');

        $status = Eventos::create([
            'nomeEvento'    => $strNomeEvento,
            'imagem'        => 'default.png',
            'cidade'        => $strCidade,
            'situacao'      => $iSituacao,
        ]);

        return response()->json([
            'status' => (bool)$status,
        ]);

    }

}
