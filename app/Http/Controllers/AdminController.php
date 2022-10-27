<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Eventos;
use App\Models\Provas;
use App\Models\Apostas;
use App\Models\Transacoes;
use App\Models\provasConjuntos;
use App\Models\User;
use App\Models\Saques;
use App\Models\Depositos;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function home(Request $request){

        $days =
        [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
        ];

        if (intval(date("d", strtotime("+1 day")) > 15)){
            $days =
            [
                16,
                17,
                18,
                19,
                20,
                21,
                22,
                23,
                24,
                25,
                26,
                27,
                28,
                29,
                30,
            ];
        }

            $DataChart = [];
            foreach ($days as $key => $value) {
                $DataChart[] = Depositos::where('situacao', 1)->whereDay('created_at', $value)->sum('valor');

            }


        return view('admin.pages.home', compact('DataChart', 'days'));
    }

    public function listaEventos(Request $request){
        $eventos = Eventos::all();
        return view('admin.pages.eventos.listaEventos', compact('eventos'));
    }

    public function novoEvento(Request $request){
        return view('admin.pages.eventos.novoEvento');
    }

    public function editarEvento($idEvento, Request $request){
        $evento = Eventos::find($idEvento);

        return view('admin.pages.eventos.editarEvento', compact('evento'));
    }

    public function provasEvento($idEvento, Request $request){
        $evento = Eventos::find($idEvento);

        return view('admin.pages.eventos.provasEvento', compact('evento'));
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

    public function _editEvento(Request $request){
        //$strNomeEvento = $request->input('nomeEvento');
        //$strCidade = $request->input('nomeCidade');
        //$iSituacao = $request->input('Situacao');
        $iIdEvento = $request->input('idEvento');

        $evento = Eventos::find($iIdEvento);

        if (!$evento){
            return response()->json([
                'status' => false,
            ]);
        }

        $evento->fill($request->only(['nomeEvento', 'cidade', 'situacao']));

        $status = $evento->save();

        return response()->json([
            'status' => (bool)$status
        ]);
    }

    public function _deleteEvento(Request $request){
        $idEvento = $request->input('idEvento');

        if (!$idEvento){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Evento não encontrado',
            ]);
        }

        $evento = Eventos::find($idEvento);

        if (Provas::whereIn('situacao', [1,2])->where('idEvento', $evento->idEvento)->count() > 0){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Não se pode excluir um evento com Provas ativas',
            ]);
        }

        Provas::where('idEvento', $evento->idEvento)->delete();

        $status = $evento->delete();

        return response()->json([
            'status'    =>  (bool)$status,
        ]);

    }

    public function _addProva(Request $request){
        //return $request->all();
        $strNomeProva = $request->input('nomeProva');
        $iEvento = $request->input('Evento');
        $strAltura = $request->input('Altura');
        $strDataProva = $request->input('dataProva');
        $strCusto = $request->input('custo');
        $strTaxa = $request->input('taxa');
        $arrNomeConjunto = $request->input('nomeConjunto');
        //$arrPrecoConjunto = $request->input('precoConjunto');

        /*for($i=0; $i < count($arrNomeConjunto); $i++){
            echo "\n\r Nome: ".$arrNomeConjunto[$i]." Preço: ".$arrPrecoConjunto[$i];
        }*/

        $prova = new Provas;
        $prova->nomeProva = $strNomeProva;
        $prova->idEvento = $iEvento;
        $prova->altura = $strAltura;
        $prova->valor = bcadd($strCusto, '0', 2);
        $prova->taxa = bcadd($strTaxa, '0', 2);
        $prova->situacao = 1;
        $prova->dataProva = Carbon::createFromFormat('d/m/Y H:i', $strDataProva)->format('Y/m/d H:i:s');

        $status = $prova->save();

        for($i=0; $i < count($arrNomeConjunto); $i++){
           $conjunto = new provasConjuntos;
           $conjunto->idProva = $prova->idProva;
           $conjunto->nomeConjunto = $arrNomeConjunto[$i];
           $conjunto->situacao = 1;

           $conjunto->save();
        }



        return response()->json([
            'status'    => (bool)$status,
            'idProva'   => $prova->idProva,
        ]);

    }

    /*public function _editProvaOld(Request $request){
        $idProva = $request->get('idProva');

        $arrIdConjunto = $request->input('idConjunto');
        $arrNomeConjunto = $request->input('nomeConjunto');

        $status = false;

        for($i=0; $i < count($arrNomeConjunto); $i++){
            if (!is_null($arrIdConjunto[$i])){
                $conjunto = provasConjuntos::find($arrIdConjunto[$i]);
                $conjunto->nomeConjunto = $arrNomeConjunto[$i];
                $status = (bool)$conjunto->save();
            }else{

                $conjunto = new provasConjuntos;
                $conjunto->nomeConjunto = $arrNomeConjunto[$i];
                $conjunto->idProva = $idProva;
                $conjunto->situacao = 1;

                $status = (bool)$conjunto->save();
            }
        }

        return response()->json([
            'status' => (bool)$status
        ]);
    }*/

    public function _editProva(Request $request){
        //return $request->all();
        $idProva = $request->get('idProva');

        $prova = Provas::find($idProva);

        $prova->nomeProva = $request->input('nomeProva');
        $prova->altura = $request->input('altura');
        $prova->dataProva = Carbon::createFromFormat('d/m/Y H:i', $request->input('dataProva'))->format('Y/m/d H:i:s');
        $prova->valor = $request->input('valor');
        $prova->taxa = $request->input('taxa');
        $prova->situacao = $request->input('situacao');

        $status = $prova->save();

        return response()->json([
            'status' => (bool)$status
        ]);
    }

    public function _deleteProva(Request $request){

        $idProva = $request->input('idProva');

        if (!$idProva){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Prova não encontrada',
            ]);
        }

        $prova = Provas::find($idProva);

        $status = $prova->delete();

        return response()->json([
            'status'    =>  (bool)$status,
        ]);

    }

    public function novaProva(Request $request){
        $eventos = Eventos::all();

        //0- inativo, 1- recebendo apostas, 2- aguardando prova, 3- finalizado, 4- cancelado

        return view('admin.pages.provas.novoProva', compact('eventos'));
    }

    public function editarProva($idProva, Request $request){
        $prova = Provas::find($idProva);
        return view('admin.pages.provas.editarProva', compact('prova'));
    }


    public function _definirVencedorProva(Request $request){
        $idProva = $request->input('idProva');
        $idConjunto = $request->input('idConjunto');

        $prova = Provas::find($idProva);

        if (!$prova){
            return response()->json([
                'status' => false,
                'msg'       =>  'Prova inexistente'
            ]);
        }

        if ($prova->situacao != 1){
            return response()->json([
                'status' => false,
                'msg'       =>  'Prova ja foi finalizada'
            ]);
        }

        $conjunto = provasConjuntos::where('idProvaConjunto', $idConjunto)->where('idProva', $idProva)->get()->first();

        if (!$conjunto){
            return response()->json([
                'status' => false,
            ]);
        }

        $saldoAcumulado = $prova->saldoAcumulado;

        $qtdVencedores = Apostas::where('idProva', $prova->idProva)->where('ConjuntoEscolhido', $conjunto->idProvaConjunto)->sum('qtdeCotas');

        /*if ($qtdVencedores < 1){
            return response()->json([
                'status' => false,
                'msg'       =>  'É necessário um mínimo de 1 aposta neste conjunto para defini-lo como vencedor',
            ]);
        }*/
        if ($qtdVencedores > 0){
            $valorIndividual = $saldoAcumulado / $qtdVencedores;

            $apostas = Apostas::where('idProva', $prova->idProva)->where('ConjuntoEscolhido', $conjunto->idProvaConjunto)->where('resultado', 0)->get();

            foreach($apostas as $aposta){
                $objAposta = Apostas::find($aposta->idAposta);
                $objAposta->resultado = 1;
                $objAposta->premio = $valorIndividual * $aposta->qtdeCotas;
                $objAposta->save();

                $transacao = new Transacoes;
                $transacao->valor       = $valorIndividual * $aposta->qtdeCotas;
                $transacao->tipo        = 4; //Receb. Aposta
                $transacao->idCliente   = $aposta->idCliente;
                $transacao->situacao    = 1;
                $transacao->save();

                //Incrementa o valorIndividual no saldo de cada cliente vencedor
                $cliente = User::find($aposta->idCliente)->increment('saldo', $valorIndividual * $aposta->qtdeCotas);

            }
        }

        $prova->situacao = 3; //0- inativo, 1- recebendo apostas, 2- aguardando prova, 3- finalizado, 4- cancelado
        $prova->idConjuntoVencedor = $conjunto->idProvaConjunto;
        $status = $prova->save();

        return response()->json([
            'status' => (bool)$status
        ]);

    }

    public function listaUsuarios(Request $request){
        $users = User::all();
        return view('admin.pages.usuarios.listaUsuarios', compact('users'));
    }

    public function novoUsuario(Request $request){
        return view('admin.pages.usuarios.novoUsuario');
    }

    public function _addUsuario(Request $request){

        if (User::where('cpf', $request->input('cpf'))->count() != 0){
            return response()->json([
                'status' => false,
                'msg'    =>  'Cpf já está em uso'
            ]);
        }elseif (User::where('email', $request->input('email'))->count() != 0){
            return response()->json([
                'status' => false,
                'msg'    =>  'Email já está em uso'
            ]);
        }

        $req_user = User::where('apikey', $request->input('apikey'))->get()->first();

        if ((($request->input('permission') == 2 || $request->input('permission') == '2') || ($request->input('permission') == 3 || $request->input('permission') == '3')) && $req_user->permission != 2){
            return response()->json([
                'status' => false,
                'msg'    =>  'Access Denied'
            ]);
        }

        $user = new User;

        $user->nome = $request->input('nome');
        $user->cpf = $request->input('cpf');
        $user->email = $request->input('email');
        $user->telefone = $request->input('telefone');
        $user->permission = $request->input('permission');
        $user->nascimento = Carbon::createFromFormat('d/m/Y H:i', $request->input('nascimento'))->format('Y/m/d H:i:s');
        $user->apikey = Str::random(16);
        $user->password = Hash::make($request->input('password'));

        $status = $user->save();

        return response()->json([
            'status' => (bool)$status,
        ]);
    }

    public function listaTransacoes(Request $request){
        $transacoes = Transacoes::all();
        return view('admin.pages.transacoes.listaTransacoes', compact('transacoes'));
    }

    public function listaSaquesPendentes(Request $request){
        $saques = Saques::where('situacao', 0)->get();
        return view('admin.pages.saques.listaSaques', compact('saques'));
    }

    public function _cancelarSaque(Request $request){
        $idSaque = $request->input('idSaque');

        if (!$idSaque){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Parametros de request inválidos',
            ]);
        }

        $saque = Saques::find($idSaque);

        if (!$saque){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Saque não encontrado',
            ]);
        }

        if ($saque->situacao != 0){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Este saque já foi cancelado anteriormente',
            ]);
        }

        $saque->situacao = 2;

        $status = $saque->save();


        $user = User::find($saque->idCliente);

        if(!$user->increment('saldo', $saque->valor)){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao restabelecer saldo ao usuário',
            ]);
        }

        return response()->json([
            'status'    =>  (bool)$status,
        ]);
    }

    public function _aprovarSaque(Request $request){
        $idSaque = $request->input('idSaque');

        if (!$idSaque){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Parametros de request inválidos',
            ]);
        }

        $saque = Saques::find($idSaque);

        if (!$saque){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Saque não encontrado',
            ]);
        }

        if ($saque->situacao != 0){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Este saque já foi cancelado anteriormente',
            ]);
        }

        $saque->situacao = 1;

        $status = $saque->save();

        $transacao = Transacoes::find($saque->idTransacao);

        $transacao->situacao = 1;

        $transacao->save();


        $user = User::find($saque->idCliente);

        /*if(!$user->increment('saldo', $saque->valor)){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao restabelecer saldo ao usuário',
            ]);
        }*/

        return response()->json([
            'status'    =>  (bool)$status,
        ]);
    }

    public function listaDepositos(Request $request){


        if (auth()->user()->permission !=2 ){
            return redirect()->route('admin.home');
        }

        $depositos = Depositos::where('situacao', 0)->get();
        return view('admin.pages.depositos.listaDepositos', compact('depositos'));
    }

    public function listaDepositosCompletos(Request $request){


        /*if (auth()->user()->permission !=2 ){
            return redirect()->route('dashboard');
        }*/

        $depositos = Depositos::where('situacao', 1)->get();

        return view('admin.pages.depositos.listaDepositosCompletos', compact('depositos'));
    }

    public function _cancelarDeposito(Request $request){
        $idDeposito = $request->input('idDeposito');

        $req_user = User::where('apikey', $request->input('apikey'))->get()->first();

        if ($req_user->permission != 2){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Access Denied!',
            ]);
        }

        if (!$idDeposito){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Parametros de request inválidos',
            ]);
        }

        $deposito = Depositos::find($idDeposito);

        if (!$deposito){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Depósito não encontrado',
            ]);
        }

        if ($deposito->situacao != 0){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Este depósito já foi cancelado anteriormente',
            ]);
        }

        $deposito->situacao = 2;

        $status = $deposito->save();

        $transacao = Transacoes::find($deposito->idTransacao);

        $transacao->situacao = 2;

        $transacao->save();


        //$user = User::find($deposito->idCliente);

        /*if(!$user->increment('saldo', $deposito->valor)){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao restabelecer saldo ao usuário',
            ]);
        }*/

        return response()->json([
            'status'    =>  (bool)$status,
        ]);
    }

    public function _aprovarDeposito(Request $request){
        $idDeposito = $request->input('idDeposito');

        if (!$idDeposito){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Parametros de request inválidos',
            ]);
        }

        $req_user = User::where('apikey', $request->input('apikey'))->get()->first();

        if ($req_user->permission != 2){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Access Denied!',
            ]);
        }

        $deposito = Depositos::find($idDeposito);

        if (!$deposito){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'deposito não encontrado',
            ]);
        }

        if ($deposito->situacao != 0){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Este deposito já foi cancelado anteriormente',
            ]);
        }

        $deposito->situacao = 1;
        $deposito->log_approver = $req_user->nome;

        $status = $deposito->save();

        $transacao = Transacoes::find($deposito->idTransacao);

        $transacao->situacao = 1;

        $transacao->save();


        $user = User::find($deposito->idCliente);

        if(!$user->increment('saldo', $deposito->valor)){
            return response()->json([
                'status'    =>  false,
                'msg'       =>  'Falha ao adicionar saldo ao Usuário',
            ]);
        }

        return response()->json([
            'status'    =>  (bool)$status,
        ]);
    }

    public function editUsuarios($idUser, Request $request){
        $user = User::find($idUser);

        return view('admin.pages.usuarios.editUsuario', compact('user'));
    }

    public function _editUsuario(Request $request){

        $auth = User::where('apikey', $request->input('apikey'))->get()->first();

        $user = User::find($request->input('idUser'));

        $user->nome = $request->input('nome');
        $user->cpf = $request->input('cpf');
        $user->email = $request->input('email');
        $user->telefone = $request->input('telefone');
        $user->nascimento = Carbon::parse($request->input('nascimento'));
        if ($auth->permission == 2){
            $user->permission = $request->input('permission');
        }

        $status = $user->save();

        return response()->json([
            'status'    => (bool)$status,
        ]);
    }

}
