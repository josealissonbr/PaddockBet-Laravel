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
                <div class="contact-form" style="5px">
                    <form class="novoDeposito-frm" action="{{route('api.dashboard.depositos.novo')}}">
                        <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="valorDeposito">Valor do Depósito</label>
                                <input type="text" id="valorDeposito" name="valorDeposito" placeholder="0,00" required>
                            </div>
                        </div>

                        <button class="submit-btn"><i class="fa fa-plus"></i> Depositar</button>
                    </form>
                    <br>
                </div>

            </div>
        </div>

        <div class="row no-gutters" id="pix-checkout-div" style="display: none;">
            <div class="col-xl-12">
                <div class="contact-form">
                    <div class="ame-qrcode-wrapper">
                        <IMG src="{{asset('assets/img/pix_logo.webp')}}" width="128px" class="logo" alt="Depósito Pix">

                        <div class="container">

                            <div class="payment-values">
                                <strong>Valor do pagamento:</strong>
                                <strong>
                                    <SPAN id="pix-payment-value">R$ 0,00</SPAN>
                                </strong>

                                <!--<P>Certifique-se de que o remetente do Pix corresponde ao CPF da sua conta.</P>-->
                            </div>

                            <IMG class="qrcode" id="pix-qrcode" src="" alt="QR Code PaddockBet">

                                <div class="payment-values">
                                    <p>Tempo restante: <strong id="timerLbl">xxx</strong></p>
                                </div>
                            <div class="payment-info d-flex justify-content-center">

                                <strong>Linha do Pix (copia e cola)</strong>
                            </div>

                            <div class="payment-info d-flex justify-content-center">
                                <input type="text" class="form-control" id="linhaPix">
                                <button role="button" style="margin-left: 5px;" class="btn btn-primary" id="copy-btn" onclick="copyPix();" data-toggle="popover" title="Copiado!">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </div>

                            <div class="payment-info justify-content-center row" style="padding-top: 10px">
                                <strong>Linha do Pix Digitável</strong>
                                <div class="col-md-12">
                                    <p type="text" class="" id="linhaPix2" style="word-wrap: break-word;">

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
