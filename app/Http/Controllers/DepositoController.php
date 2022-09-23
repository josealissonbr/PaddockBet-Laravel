<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;
use App\Models\Depositos;
use App\Models\User;
use Carbon\Carbon;

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
              "expiracao": 3600
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

    public function historico(Request $request){

        $depositos = Depositos::where('idCliente', auth()->user()->id)->orderBy('created_at','DESC')->paginate(15);
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

        if ($valorDeposito < 1.00){
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

        $access_token = $this->sicoob_RequisitarToken();
        $loc = $this->sicoob_CriarLocPayload($access_token);
        //return $loc;
        $cobranca = $this->sicoob_CriarCobranca($access_token, $loc->id, $user->name, $user->cpf, $valorDeposito, $deposito->id);

        $deposito->txid = $cobranca->txid;
        $deposito->save();

        return response()->json([
            'status'        =>  true,
            'idTransacao'   =>  $transacao->idTransacao,
            'idDeposito'    =>  $deposito->id,
            'pix'           =>  $cobranca->brcode
        ]);
    }

    public function _processPayments(Request $request){
        $inicio_datetime = Carbon::now()->subHours(20);
        $fim_datetime = Carbon::now();
        //return $inicio_datetime->format('Y-m-d\TH:i:s.uP');

        $access_token = $this->sicoob_RequisitarToken();

        $response = $this->sicoob_ListaCobranca($access_token);

        foreach ($response->cobs as $cob){

            $rDeposito = Depositos::where('txid', $cob->txid)->where('situacao', '!=', 1)->get()->first();

            if ($rDeposito){
                $deposito = Depositos::find($rDeposito->id);
                $deposito->situacao = 1;

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
