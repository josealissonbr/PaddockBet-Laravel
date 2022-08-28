@extends('layouts.app')

@section('script')
    <script>
        $('.btn-number').click(function(e){
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {

                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });

        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
@endsection

@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>20/08/2022 Campeonato Brasileiro - Etapa Maceió</h3>
                    <h3>Faça sua aposta: </h3>
                </div>
            </div>
        </div>

    </div>
</div>
    <!-- payment history end -->
 <!-- bet-slip begin -->
<div class="bet-slip" style="padding: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="bet-slip-content">
                    <div class="box-heading">
                        <h4>Provas</h4>
                        <h4></h4>
                    </div>
                    <div>
                        <div class="different-bet">

                            <div class="single-bet">

                                <div class="left-side">
                                    <span class="bet-place">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y h:i')}} - {{$prova->nomeProva}}</span>
                                    <span class="bet-price">{{$prova->altura}}</span>
                                </div>

                            </div>
                           <form action="apostas.php">
                                <div class="row">
                                    <div class="left-side col-md-6">
                                        <span class="bet-place"></span>
                                        <span class="bet-price">
                                            <label> Selecione o conjunto vencedor</label>
                                            <select name="p1" class="form-control formulario">
                                                <option value="0">Selecione</option>
                                                @foreach ($prova->conjuntos as $conjunto)
                                                <option value="{{$conjunto->idProvaConjunto}}">{{$conjunto->nomeConjunto}}</option>
                                                @endforeach
                                            </select>
                                                {{--12 pontos--}}
                                            </span>
                                    </div>
                                </div>


                                <br>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn btn-outline-secondary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="quant[1]">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" align="center">
                                    <div class="right-side">

                                        <br>
                                        <div class="buttons">
                                            <a href="apostas.php?idProva=1" class="buy-ticket bet-btn bet-btn-dark-light">
                                                <i class="fa fa-save"></i> Fazer Palpite
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>




                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bet-slip-sidebar">

                    <h4 class="title">{{$prova->evento->nomeEvento}} <br> {{$prova->nomeProva}}</h4>
                    <h3 class="title" style="text-align:  center">{{$prova->nomeProva}} {{$prova->altura}}</h4>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <span class="title">Início</span>
                                <span class="number">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y')}}</span>
                            </li>
                            <li>
                                <span class="title">Valor Por Palpite</span>
                                <span class="number">R$ {{number_format($prova->valor, 2, ",", ".")}}<span>
                            </li>
                        </ul>
                        <div class="total-returns">
                            <span class="text">
                                Prêmio Total desta prova
                            </span>
                            <span class="number">
                                R$ {{number_format($prova->saldoAcumulado, 2, ",", ".")}}
                            </span>
                             <span class="text">
                               Obs.: O Prêmio aumenta de acordo com o número de palpites
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bet-slip end -->
@endsection
