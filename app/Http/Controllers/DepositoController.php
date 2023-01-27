<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Transacoes;
use App\Models\Depositos;
use App\Models\User;
use Carbon\Carbon;
use \App\Pix\Api;
use \App\Pix\Payload;

//require_once base_path('resources/views')."/phpqrcode/qrlib.php";
require_once base_path('resources/views').'/funcoes_pix.php';

class DepositoController extends Controller
{

    public function sicoob_RequisitarToken(){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";

        ///return base_path('resources/pix_res') . "/client.pem";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=93055852-9d4b-48e4-8eca-43bc992edd44&scope=cob.read%20cob.write%20cobv.write%20cobv.read%20lotecobv.write%20lotecobv.read%20pix.write%20pix.read%20webhook.read%20webhook.write%20payloadlocation.write%20payloadlocation.read");

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse->access_token;
    }

    public function sicoob_CriarLocPayload($access_token){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";

        ///return base_path('resources/pix_res') . "/client.pem";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sicoob.com.br/pix/api/v2/loc");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            'client_id: 93055852-9d4b-48e4-8eca-43bc992edd44',
            'Content-Type: application/json'
          ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "tipoCob": "cob"
          }');

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse;
    }

    public function sicoob_CriarCobranca($access_token, $loc_id, $user_name, $cpf, $valorDeposito, $deposito_id){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";

        ///return base_path('resources/pix_res') . "/client.pem";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sicoob.com.br/pix/api/v2/cob");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            'client_id: 93055852-9d4b-48e4-8eca-43bc992edd44',
            'Content-Type: application/json'
          ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "calendario": {
              "expiracao": 36000
            },
            "devedor": {
              "cpf": "'.$cpf.'",
              "nome": "'.$user_name.'"
            },
            "loc": {
              "id": '.$loc_id.'
            },
            "valor": {
              "original": "'.$valorDeposito.'"
            },
            "chave": "47595949000145",
            "solicitacaoPagador": "2",
            "infoAdicionais": [
              {
                "nome": "Deposito #'.$deposito_id.'",
                "valor": "'.$valorDeposito.'"
              }
            ]
          }');

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse;
    }

    public function bacen_CriarCobranca($arrConfig){

        /**
         * [
            'nome'  => $user->nome,
            'cpf'   => $user->cpf,
            'valorDeposito' => $valorDeposito,
            'deposito' => $deposito->id
            ]
         */


        $certificado = base_path('resources/pix_res')."/paddock_prod.pem";

        $obApiPix = new Api('https://api-pix.gerencianet.com.br',
                    'Client_Id_47635b105b722eeac5097868cce643be5c769413',
                    'Client_Secret_03ce4d2a734287b2e3ef1d01296eacef2e2f34dc',
                    $certificado);

        //CORPO DA REQUISIÇÃO
        $request = [
            'calendario' => [
                'expiracao' => 3600
            ],
            'devedor' => [
                'cpf' => $arrConfig['cpf'],
                'nome' => $arrConfig['nome']
            ],
            'valor' => [
                'original' => $arrConfig['valorDeposito']
            ],
            'chave' => "a76d07f0-273b-46fa-a766-b04add2c575b",
            'solicitacaoPagador' => 'Pagamento do pedido #'.$arrConfig['deposito']
        ];

        //RESPOSTA DA REQUISIÇÃO DE CRIAÇÃO
        $response = $obApiPix->createCob(Str::random(26),$request);

        if(!isset($response['location'])){
            echo "<pre>";
            print_r($gerencianet);
            echo "</pre>";
            return false;
        }

        //INSTANCIA PRINCIPAL DO PAYLOAD PIX
        $obPayload = (new Payload)->setMerchantName('PaddockBet')
        ->setMerchantCity('SAO PAULO')
        ->setAmount($response['valor']['original'])
        ->setTxid('***')
        ->setUrl($response['location'])
        ->setUniquePayment(true);

        //CÓDIGO DE PAGAMENTO PIX
        $payloadQrCode = $obPayload->getPayload();

        return [
            'payload' => $payloadQrCode,
            'txid'    => $response['txid'],
        ];
    }

    public function sicoob_ListaCobranca($access_token){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";
        //$inicio_datetime->format('Y-m-d\TH:i:s.uP')
        $inicio_datetime = Carbon::now()->subHours(20)->format('Y-m-d\TH:i:s.uP');
        $fim_datetime = Carbon::now()->format('Y-m-d\TH:i:s.uP');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sicoob.com.br/pix/api/v2/cob?inicio=$inicio_datetime&fim=$fim_datetime&locationPresent=true&status=CONCLUIDA&paginacao.paginaAtual=0&paginacao.itensPorPagina=1000");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            'client_id: 93055852-9d4b-48e4-8eca-43bc992edd44',
            'Content-Type: application/json'
          ));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        //     "tipoCob": "cob"
        //   }');

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse;
    }

    public function sicoob_ConsultarCobranca($access_token, $txid){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";
        //$inicio_datetime->format('Y-m-d\TH:i:s.uP')
        $inicio_datetime = Carbon::now()->subHours(20)->format('Y-m-d\TH:i:s.uP');
        $fim_datetime = Carbon::now()->format('Y-m-d\TH:i:s.uP');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sicoob.com.br/pix/api/v2/cob/$txid");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            'client_id: 93055852-9d4b-48e4-8eca-43bc992edd44',
            'Content-Type: application/json'
          ));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        //     "tipoCob": "cob"
        //   }');

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse;
    }

    public function sicoob_ChecarCobranca_raw($access_token, $txid){
        $curl = curl_init();

        $certFile = base_path('resources/pix_res')."/cert.p12";
        $certPass = "equestrian";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sicoob.com.br/pix/api/v2/cob/$txid");
        curl_setopt($ch, CURLOPT_PORT , 443);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSLCERT, base_path('resources/pix_res') . "/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, base_path('resources/pix_res') . "/key.pem");
        //curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            'client_id: 93055852-9d4b-48e4-8eca-43bc992edd44',
            'Content-Type: application/json'
          ));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        //     "tipoCob": "cob"
        //   }');

        $response = curl_exec($ch);
        $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);

        curl_close($ch);

        $arrResponse = json_decode($response);

        return $arrResponse;
    }

    public function bCheckCobranca($txid){
        $access_token = $this->sicoob_RequisitarToken();
        $response = $this->sicoob_ChecarCobranca_raw($access_token, $txid);
        return ($response->status == "CONCLUIDA") ? true : false;
    }

    public function historico(Request $request){

        $depositos = Depositos::where('idCliente', auth()->user()->id)->orderBy('created_at','DESC')->paginate(15);
        //return $transacoes;
        return view('pages.depositos', compact('depositos'));
    }

    public function novoDeposito(Request $request){
        return view('pages.novoDeposito');
    }

    public function pagarDeposito($idDeposito, Request $request){

        $deposito = Depositos::find($idDeposito);

        if ($deposito->idCliente != auth()->user()->id){
            return redirect(route('dashboard.depositos.historico'));
        }

        //$access_token = $this->sicoob_RequisitarToken();

        //$sicoob = $this->sicoob_ConsultarCobranca($access_token, $deposito->txid);

        $certificado = base_path('resources/pix_res')."/paddock_prod.pem";

        $obApiPix = new Api('https://api-pix.gerencianet.com.br',
                    'Client_Id_47635b105b722eeac5097868cce643be5c769413',
                    'Client_Secret_03ce4d2a734287b2e3ef1d01296eacef2e2f34dc',
                    $certificado);

        $gerencianet = $obApiPix->consultCob($deposito->txid);

        if ($gerencianet['status'] != 'ATIVA'){
            return 'Ocorreu um erro.';
        }

        /*echo "<pre>";
        print_r($gerencianet);
        echo "</pre>"; exit;*/

        //INSTANCIA PRINCIPAL DO PAYLOAD PIX
        $obPayload = (new Payload)->setMerchantName('PaddockBet')
        ->setMerchantCity('SAO PAULO')
        ->setAmount($gerencianet['valor']['original'])
        ->setTxid('***')
        ->setUrl($gerencianet['location'])
        ->setUniquePayment(true);

        //CÓDIGO DE PAGAMENTO PIX
        $payloadQrCode = $obPayload->getPayload();

        return view('pages.pagarDeposito', compact('deposito', 'gerencianet', 'payloadQrCode'));
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

        if ($valorDeposito < 0.01){
            return response()->json([
                'status' => false,
                'msg' => 'Valor mínimo para depósito é de R$1,00'
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

       // $access_token = $this->sicoob_RequisitarToken();
        //$loc = $this->sicoob_CriarLocPayload($access_token);
        //return $loc;
        //$cobranca = $this->sicoob_CriarCobranca($access_token, $loc->id, $user->nome, $user->cpf, $valorDeposito, $deposito->id);
        $cobranca = $this->bacen_CriarCobranca([
            'nome'  => $user->nome,
            'cpf'   => $user->cpf,
            'valorDeposito' => $valorDeposito,
            'deposito' => $deposito->id
        ]);

        echo "<pre>";
        print_r($cobranca);
        echo "</pre>"; exit;

        $deposito->txid = $cobranca['txid'];
        $deposito->save();

        //Recalcular Saldo
        \App\Helpers\mainHelper::recalcSaldo($user->id);

        return response()->json([
            'status'        =>  true,
            'idTransacao'   =>  $transacao->idTransacao,
            'idDeposito'    =>  $deposito->id,
            'pix'           =>  $cobranca['payload']
        ]);
    }

    public function _processPayments_bkp(Request $request){
        $inicio_datetime = Carbon::now()->subHours(20);
        $fim_datetime = Carbon::now();

        $access_token = $this->sicoob_RequisitarToken();

        $response = $this->sicoob_ListaCobranca($access_token);

        foreach ($response->cobs as $cob){

            $rDeposito = Depositos::where('txid', $cob->txid)->where('situacao', '!=', 1)->get()->first();

            if ($rDeposito){
                $deposito = Depositos::find($rDeposito->id);

                if ($deposito->situacao == 1){
                    continue;
                }

                $deposito->situacao = 1;
                $deposito->log_approver = "Sicoob";

                $transacao = Transacoes::find($rDeposito->idTransacao);
                $transacao->situacao = 1;

                $user = User::find($deposito->idCliente);

                $deposito->save();
                $transacao->save();
                $user->increment('saldo', $deposito->valor);
            }else{
                continue;
            }

        }
    }

    public function _processPayments(Request $request){
        $certificado = base_path('resources/pix_res')."/certificado.pem";

        $obApiPix = new Api('https://api-pix-h.gerencianet.com.br',
                    'Client_Id_47635b105b722eeac5097868cce643be5c769413',
                    'Client_Secret_03ce4d2a734287b2e3ef1d01296eacef2e2f34dc',
                    $certificado);

        //RESPOSTA DA REQUISIÇÃO DE CRIAÇÃO
        $response = $obApiPix->consultCob("TWuE1jgZfuiXQiY83v6firqVfc");

        //VERIFICA A EXISTÊNCIA DO ITEM 'LOCATION'
        if(!isset($response['location'])){
            echo 'Problemas ao consultar Pix dinâmico';
            echo "<pre>";
            print_r($response);
            echo "</pre>"; exit;
        }

        //DEBUG DOS DADOS DO RETORNO
        echo "<pre>";
        print_r($response);
        echo "</pre>"; exit;
    }

    public function _processPayments_v2(Request $request){

        $inicio_datetime = Carbon::now()->subHours(20)->format('Y-m-d\TH:i:s.uP');
        $fim_datetime = Carbon::now()->format('Y-m-d\TH:i:s.uP');
        //return $fim_datetime;
        $certificado = base_path('resources/pix_res')."/paddock_prod.pem";

        $obApiPix = new Api('https://api-pix.gerencianet.com.br',
                    'Client_Id_47635b105b722eeac5097868cce643be5c769413',
                    'Client_Secret_03ce4d2a734287b2e3ef1d01296eacef2e2f34dc',
                    $certificado);

        $response = $obApiPix->consultCobList('inicio='.$inicio_datetime.'&fim='.$fim_datetime.'&status=CONCLUIDA');

        /*echo "<pre>";
        print_r($response);
        echo "</pre>"; exit;*/

        foreach ($response['cobs'] as $cob){

            if (!isset($cob['txid']))
                continue;

            $rDeposito = Depositos::where('txid', $cob['txid'])->where('situacao', '!=', 1)->get()->first();

            if ($rDeposito){
                $deposito = Depositos::find($rDeposito->id);

                if ($deposito->situacao == 1){
                    continue;
                }

                $deposito->situacao = 1;
                $deposito->log_approver = "GerenciaNet";

                $transacao = Transacoes::find($rDeposito->idTransacao);
                $transacao->situacao = 1;

                $user = User::find($deposito->idCliente);

                $deposito->save();
                $transacao->save();
                $user->increment('saldo', $deposito->valor);
            }else{
                continue;
            }

        }

    }

    public function _checkDeposit(Request $request){
        $apikey = $request->input('apikey');
        $idDeposito = $request->input('depositID');

        if (!$apikey || !$idDeposito){
            return response()->json([
                'status '    => false,
                'msg'        => 'Parametros Insuficientes'
            ]);
        }

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        if (!$user){
            return response()->json([
                'status '    => false,
                'msg'        => 'Invalid APIKEY for valid User'
            ]);
        }

        $deposito = Depositos::find($idDeposito);

        if (!$deposito){
            return response()->json([
                'status '    => false,
                'msg'        => 'Invalid Deposit ID'
            ]);
        }

        return response()->json([
            'status'   => ($deposito->situacao == 1) ? true : false,
        ]);

    }
}
