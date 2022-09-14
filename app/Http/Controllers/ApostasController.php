<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apostas;
use App\Models\Eventos;
use App\Models\Provas;
use App\Models\provasConjuntos;
use App\Models\Transacoes;
use Carbon\Carbon;

class ApostasController extends Controller
{
    //
    public function index(){
        $apostas = Apostas::where('idCliente', auth()->user()->id)->with('prova')->get();
       // return $apostas;
        return view('pages.apostas', compact('apostas'));
    }

    public function detalhesBilhete($idAposta){
        $aposta = Apostas::find($idAposta);
        //return $aposta->conjuntoSelecionado;
        return view('pages.detalhesBilhete', compact('aposta'));
    }

    public function palpite($idProva){
        $prova = Provas::find($idProva);
        //return $prova->conjuntos;
        return view('pages.palpite', compact('prova'));
    }

    public function provas($idEvento){
        $evento = Eventos::find($idEvento);
        $provas = Provas::where('idEvento', $idEvento)->where('situacao', 1)->get();
        $acumuladoEvento = Provas::where('idEvento', $idEvento)->where('situacao', 1)->sum('saldoAcumulado');

        //return $provas;
        return view('pages.provas', compact('evento', 'provas', 'acumuladoEvento'));
    }

    public function eventos(){
        $eventos = Eventos::get();

        return view('pages.eventos', compact('eventos'));
    }

    public function _EfetuarPalpite(Request $request){
        //return $request->all();

        $idProva = $request->input('idProva');
        $conjuntoSelecionado = $request->input('conjuntoSelecionado');
        $qtdCotas = $request->input('qtdCotas');

        $user = User::where('apikey', $request->input('apikey'))->get()->first();
        $prova = Provas::find($idProva);

        if (!$user){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao validar usuario'
            ]);
        }

        if (!$prova){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao validar a prova escolhida'
            ]);
        }

        if (provasConjuntos::where('idProvaConjunto', $conjuntoSelecionado)->count() != 1){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao validar o conjunto escolhido'
            ]);
        }

        if ($qtdCotas < 1 || $qtdCotas > 99){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Quantidade de cotas incorreta'
            ]);
        }

        if ($user->saldo < ($prova->valor * $qtdCotas)){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Saldo insuficiente'
            ]);
        }

        $aposta = new Apostas;

        $now = Carbon::now();

        $aposta->idCliente = $user->id;
        $aposta->idCliente = $user->id;
        $aposta->qtdeCotas = $qtdCotas;
        $aposta->idProva = $prova->idProva;
        $aposta->valorAposta = ($prova->valor * $qtdCotas);
        $aposta->hash = md5('alisson@eric:'.$now);
        $aposta->ConjuntoEscolhido = $conjuntoSelecionado;
        $aposta->created_at = $now;

        if(!$aposta->save()){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao criar aposta'
            ]);
        }

        $aposta->hash = md5($aposta->idAposta.env('HASH_PASSWD').$aposta->ConjuntoEscolhido);

        $aposta->save();

        $prova->increment('saldoAcumulado', ($prova->valor * $qtdCotas) - (($prova->valor * $qtdCotas) * 0.3));

        $user->saldo = ($user->saldo - ($prova->valor * $qtdCotas));

        $transacao = new Transacoes;

        $transacao->tipo = 2;//1- deposito, 2-aposta, 3- saque
        $transacao->idCliente = $user->id;
        $transacao->valor = ($prova->valor * $qtdCotas);
        $transacao->situacao = 1;

        $transacao->save();
        $user->save();
        //$prova->save();

        return response()->json([
            'status'        =>  true,
            'msg'           =>  'Aposta criada com sucesso!',
            'redirector'    =>  route('dashboard.apostas.detalhes', $aposta->idAposta),
        ]);

    }
}
