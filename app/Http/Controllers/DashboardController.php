<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use App\Models\Apostas;
use App\Models\Transacoes;
use App\Models\User;
use App\Models\Saques;
use App\Models\Depositos;
use Carbon\Carbon;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
use \App\Pix\Api;
use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class DashboardController extends Controller
{
    public function index(){
        if (!Auth::Check()){
            if ( \App\Models\Eventos::where('situacao', 1)->limit(5)->count() < 1){
                return redirect(route('login'));
            }

            return view('pages.index');
        }
        return redirect('dashboard');
    }

    public static function test_gn(){

        $config = [
            "certificado" => base_path('resources/pix_res')."/certificado.pem",
            "client_id" => "Client_Id_5c5e35ce3e01bb20d8a03a98e55917e790eb6308",
            "client_secret" => "Client_Secret_0c3ffea0e52f58f06e4ffe9cc74c59ddac4062d6"
        ];
        $autorizacao =  base64_encode($config["client_id"] . ":" . $config["client_secret"]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-pix-h.gerencianet.com.br/oauth/token", // Rota base, homologação ou produção
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"grant_type": "client_credentials"}',
            CURLOPT_SSLCERT => $config["certificado"], // Caminho do certificado
            CURLOPT_SSLCERTPASSWD => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $autorizacao",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resposta = json_decode($response);

        return $resposta->access_token;


    }

    public function v2_cob(Request $request){

        $cfgClientID= 'Client_Id_5c5e35ce3e01bb20d8a03a98e55917e790eb6308';
        $cfgClientSecret = 'Client_Secret_0c3ffea0e52f58f06e4ffe9cc74c59ddac4062d6';

        $certificado = base_path('resources/pix_res')."/certificado.pem";

        $obApiPix = new Api('https://api-pix-h.gerencianet.com.br',
                    'Client_Id_5c5e35ce3e01bb20d8a03a98e55917e790eb6308',
                    'Client_Secret_0c3ffea0e52f58f06e4ffe9cc74c59ddac4062d6',
                    $certificado);

        //CORPO DA REQUISIÇÃO
        $request = [
            'calendario' => [
                'expiracao' => 3600
            ],
            'devedor' => [
                'cpf' => '12345678909',
                'nome' => 'Fulano de Tal'
            ],
            'valor' => [
                'original' => '10.00'
            ],
            'chave' => "15788943442",
            'solicitacaoPagador' => 'Pagamento do pedido 123'
        ];

        //RESPOSTA DA REQUISIÇÃO DE CRIAÇÃO
        $response = $obApiPix->createCob(Str::random(26),$request);

        if(!isset($response['location'])){
            echo 'Problemas ao gerar Pix dinâmico';
            echo "<pre>";
            print_r($response);
            echo "</pre>"; exit;
        }

        //INSTANCIA PRINCIPAL DO PAYLOAD PIX
        $obPayload = (new Payload)->setMerchantName('AlissonSantos')
        ->setMerchantCity('MACEIO')
        ->setAmount($response['valor']['original'])
        ->setTxid('***')
        ->setUrl($response['location'])
        ->setUniquePayment(true);

        //CÓDIGO DE PAGAMENTO PIX
        $payloadQrCode = $obPayload->getPayload();

        // echo "<pre>";
        //     print_r($payloadQrCode);
        //     echo "</pre>"; exit;

        //QR CODE
        //$obQrCode = new QrCode($payloadQrCode);

        //IMAGEM DO QRCODE
       // $output = new Output\Png();
        //$image = $output->output($obQrCode, 100, [255, 255, 255], [0, 0, 0]);

        return '<h1>QR CODE DINÂMICO DO PIX</h1>

        <br>

        <img src="https://chart.googleapis.com/chart?chs=420x420&cht=qr&chl='.$payloadQrCode.'">

        <br><br>

        Código pix:<br>
        <strong>'.$payloadQrCode.'</strong>';

    }

    public function recalcSaldo(Request $request){

        if ($request->input('secret') != 'Alisson@Eric'){
            return 'ACCESS_DENIED';
        }

        $users = User::all();

        foreach($users as $user){
            $saldoUsuario = 0.00;

            $depositos = Depositos::where('situacao', 1)->where('idCliente', $user->id)->sum('valor');

            $apostas = Transacoes::where('idCliente', $user->id)->where('tipo', 2)->sum('valor');

            $saques = Saques::where('idCliente', $user->id)->whereIn('situacao', [0,1])->sum('valor');

            $recebApostas = Transacoes::where('idCliente', $user->id)->where('tipo', 4)->sum('valor');

            $saldoUsuario = $depositos - $apostas - $saques + $recebApostas;

            $user->saldo2 = $saldoUsuario;

            $user->save();
        }

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

            if (!isset( $aposta->prova->situacao) || $aposta->prova->situacao == 1 || $aposta->prova->situacao == 2){
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

    public function _atualizarPerfil(Request $request){

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        $passwordOld = $request->input('passwordNo');

        if (!$user){
            return response()->json([
                'status'    =>  false,
                'msg'       => 'Falha ao autenticar.'
            ]);
        }

        if ($passwordOld){
            $user->password = Hash::make($passwordOld);
        }

        $user->save();

        return response()->json([
            'status'    =>  true,
            'msg'       => 'Alterações aplicadas com sucesso!'
        ]);

    }

    public function Saques(Request $request){
        $saques = Saques::where('idCliente', auth()->user()->id)->get();
        return view('pages.saques', compact('saques'));
    }

    public function novoSaque(){
        return view('pages.novoSaque');
    }

    public function termosDeUso(Request $request){
        return view('pages.TermosDeUso');
    }

    public function _aceitarTermos(Request $request){
        $apikey = $request->input('apikey');
        $user = User::where('apikey', $apikey)->get()->first();

        $user->acceptTerms = Carbon::now();

        $user->save();
    }

    public function _solicitarSaque(Request $request){
        $valorSaque = $request->input('valorSaque');
        //Converter comma "," em dot "."
        $valorSaque = str_replace(',','.', $valorSaque);

        if (!$valorSaque){
            return response()->json([
                'status' => false,
                'msg'       =>  'Parametros inválidos',
            ]);
        }

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        if(!$user){
            return response()->json([
                'status' => false,
                'msg'       =>  'Falha ao obter o usuário',
            ]);
        }

        if ($user->saldo < $valorSaque){
            return response()->json([
                'status' => false,
                'msg'       =>  'Saldo insuficiente',
            ]);
        }

        $transacao = new Transacoes;

        $transacao->tipo = 3;
        $transacao->idCliente = $user->id;
        $transacao->valor = $valorSaque;
        $transacao->situacao = 0;
        $transacao->save();

        $saque = new Saques;

        $saque->idCliente = $user->id;
        $saque->valor = $valorSaque;
        $saque->situacao = 0;
        $saque->idTransacao = $transacao->idTransacao;

        $status = $saque->save();

        //Recalcular Saldo
        \App\Helpers\mainHelper::recalcSaldo($user->id);

        if ($status){

            $user->decrement('saldo', $saque->valor);

            return response()->json([
                'status'    => true,
                'msg'       =>  'Saque solicitado com sucesso',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg'       =>  'Falha ao solicitar Saque',
            ]);
        }



    }

}
