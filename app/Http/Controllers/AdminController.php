<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Provas;
use Carbon\Carbon;

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

    public function _addProva(Request $request){
        $strNomeProva = $request->input('nomeProva');
        $iEvento = $request->input('Evento');
        $strAltura = $request->input('Altura');
        $strDataProva = $request->input('dataProva');
        $strCusto = $request->input('custo');
        $strTaxa = $request->input('taxa');

        $prova = new Provas;
        $prova->nomeProva = $strNomeProva;
        $prova->idEvento = $iEvento;
        $prova->altura = $strAltura;
        $prova->valor = bcadd($strCusto, '0', 2);
        $prova->taxa = bcadd($strTaxa, '0', 2);
        $prova->dataProva = Carbon::parse($strDataProva)->format('Y/m/d H:i:s');

        $status = $prova->save();

        return response()->json([
            'status' => (bool)$status
        ]);

    }


    public function novaProva(Request $request){
        $eventos = Eventos::all();

        //0- inativo, 1- recebendo apostas, 2- aguardando prova, 3- finalizado, 4- cancelado

        return view('admin.pages.provas.novoProva', compact('eventos'));
    }

}
