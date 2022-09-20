<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;
use App\Models\Depositos;
use App\Models\User;

//require_once base_path('resources/views')."/phpqrcode/qrlib.php";
require_once base_path('resources/views').'/funcoes_pix.php';

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

        $px[00]="01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
        // Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
        //$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez.
        $px[26][00]="BR.GOV.BCB.PIX"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
        $px[26][01]="64c21329-043b-4417-80b6-ca4f621c700f"; //Chave do destinatário do pix, pode ser EVP, e-mail, CPF ou CNPJ.

        $px[52]="0000"; //Merchant Category Code “0000” ou MCC ISO18245
        $px[53]="986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
        $px[54]=$valorDeposito; //Valor da transação, se comentado o cliente especifica o valor da transação no próprio app. Utilizar o . como separador decimal. Máximo: 13 caracteres.
        $px[58]="BR"; //“BR” – Código de país ISO3166-1 alpha 2
        $px[59]="ERIC MARTINS"; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
        $px[60]="MACEIO"; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
        $px[62][05]="010001"; //Identificador de transação, quando gerado automaticamente usar ***. Limite 25 caracteres. Vide nota abaixo.

        $pix=montaPix($px);


        $pix.="6304"; //Adiciona o campo do CRC no fim da linha do pix.
        $pix.=crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.

        return response()->json([
            'status'        =>  true,
            'idTransacao'   =>  $transacao->idTransacao,
            'idDeposito'    =>  $deposito->id,
            'pix'           =>  $pix
        ]);
    }
}
