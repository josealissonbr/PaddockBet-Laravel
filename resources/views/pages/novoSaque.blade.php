@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/contact-page-responsive.css')}}">
@endsection

@section('script')
<script src="{{asset('assets/js/jquery.maskMoney.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/custom/novoSaque.js')}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="contact"  style="padding-top: 10px; padding-bottom: 10px">
    <div class="container" style="padding-top: 10px">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="contact-form">
                    <form class="novoSaque-frm" action="{{route('api.dashboard.saques.solicitar')}}">
                        <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="valorSaque">Valor do Saque</label>
                                <input type="text" id="valorSaque" name="valorSaque" placeholder="0,00" required>
                            </div>
                        </div>
                        <label for="yourMessage">Alguma Observação? (Opcional)</label>
                        <textarea id="yourMessage" placeholder=""></textarea>
                        <button class="submit-btn">Solicitar</button>
                    </form>
                    <br>
                    <label>Obs: Enviaremos um Pix para o seu CPF.</label>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
