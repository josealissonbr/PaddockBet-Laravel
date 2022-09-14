@extends('layouts.app')

@section('script')
<script src="{{asset('assets/js/jquery.maskMoney.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/custom/novoDeposito.js')}}" type="text/javascript"></script>
@endsection

@section('css')
<STYLE type="text/css">
    .title {
        font-size: 14px;
        font-weight: 500;
        color: #111705;
        line-height: 28px;
        text-transform: uppercase;
    }
    .ame-qrcode-wrapper{
        width: 100%;
        max-width: 340px;
        margin: 40px auto;
    }

    .ame-qrcode-wrapper p,
    .ame-qrcode-wrapper strong,
    .ame-qrcode-wrapper span{
        font-family: 'Ubuntu';
        font-size: 12px;
    }

    .ame-qrcode-wrapper .logo{
        display: block;
        margin: 0 auto;
    }

    .ame-qrcode-wrapper .container{
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 15px;
    }

    .ame-qrcode-wrapper .payment-values{
        text-align: center
    }

    .ame-qrcode-wrapper .payment-values strong{
        display: block;
    }

    .ame-qrcode-wrapper .payment-values strong:first-child{
        margin-bottom: 5px;
    }

    .ame-qrcode-wrapper .payment-values strong span{
        color: #ED555D;
        font-size: 16px;
    }

    .ame-qrcode-wrapper .payment-values p strong{
        display: inline;
        color: #4a90e2;
    }

    .ame-qrcode-wrapper img.qrcode{
        display: block;
        margin: 10px auto;
    }

    .ame-qrcode-wrapper .payment-info > strong{
        color: #ED555D;
        font-size: 16px;
        text-align: center;
        text-align: justify;
    }

    .ame-qrcode-wrapper .payment-info ul {
        list-style: none;
        padding: 0;
    }

    .ame-qrcode-wrapper .payment-info ul li {
        color: #aaaaaa;
    font-size: 12px;
        margin-bottom: 10px;
    }

    .ame-qrcode-wrapper .payment-info ul li p {
        height: 15px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin: 5px 0;
    }

    .ame-qrcode-wrapper .payment-info ul li strong,
    .ame-qrcode-wrapper .payment-info ul li img{
        margin: 0 2px
    }

    .ame-qrcode-wrapper a {
        color: #aaaaaa;
    font-size: 12px;
    }
</STYLE>
@endsection

@section('content')
<div class="contact"  style="padding-top: 10px; padding-bottom: 10px">
    <div class="container" style="padding-top: 10px">
        <div class="row no-gutters" id="pix-frm-div">
            <div class="col-xl-12">
                <div class="contact-form">
                    <form class="novoDeposito-frm" action="{{route('api.dashboard.saques.solicitar')}}">
                        <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="valorDeposito">Valor do Depósito</label>
                                <input type="text" id="valorDeposito" name="valorDeposito" placeholder="0,00" required>
                            </div>
                        </div>

                        <button class="submit-btn">Depositar</button>
                    </form>
                    <br>
                </div>

            </div>
        </div>

        <div class="row no-gutters" id="pix-checkout-div" style="display: none;">
            <div class="col-xl-12">
                <div class="contact-form">
                    <DIV class="ame-qrcode-wrapper">
                        <IMG src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg/2560px-Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg.png" width="128px" class="logo" alt="Depósito Pix">

                        <DIV class="container">

                            <DIV class="payment-values">
                                <strong>Valor do depósito:</strong>
                                <strong>
                                    <SPAN>R$ 0,00</SPAN>
                                </strong>

                                <P>Receba de volta <strong>R$ 0,00</strong> em até 30 dias.</P>
                            </DIV>

                            <IMG class="qrcode" src="https://img.ibxk.com.br/materias/890270071.jpg" alt="QR Code Ame Digital">

                            <DIV class="payment-info d-flex justify-content-center">
                                <strong>Linha do Pix (copia e cola)</strong>
                            </DIV>

                            <DIV class="payment-info d-flex justify-content-center">
                                <input type="text" class="form-control" id="linhaPix" value="00020126580014BR.GOV.BCB.PIX013664c21329-043b-4417-80b6-ca4f621c700f520400005303986540510.005802BR5912ERIC MARTINS6006MACEIO62100506010001630494F8" />
                                <button role="button" style="margin-left: 5px;" class="btn btn-primary" id="copy-btn" data-toggle="popover" data-trigger="focus" title="Copiado!">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </DIV>

                        </DIV>
                    </DIV>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
