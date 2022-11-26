@extends('layouts.app')

@section('script')
    <script src="{{asset('assets/js/custom/palpites.js')}}?v={{time()}}"></script>

    <script>
        window.onload = function() {
            setData({{$prova->evento->idEvento}}, {{$prova->idProva}});
        }

        defineKeys('{{auth()->user()->apikey}}','{{URL::to('/')}}');
    </script>
@endsection

@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>{{$prova->evento->nomeEvento}} - {{$prova->nomeProva}}</h3>
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
                        <h4>Apostar</h4>
                        <h4></h4>
                    </div>
                    <div>
                        <div class="different-bet">

                            <div class="single-bet">

                                <div class="left-side">
                                    <span class="bet-place">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i')}} - {{$prova->nomeProva}}</span>
                                    <span class="bet-price">{{$prova->altura}}</span>
                                </div>

                            </div>
                           <form id="efetuar-palpite-frm" action="{{route('api.provas.fazerPalpite')}}" method="POST">
                                <input type="hidden" name="idProva" value="{{$prova->idProva}}">
                                <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
                                <input type="hidden" id="valorProva" value="{{$prova->valor}}">
                                <input type="hidden" id="userSaldo" value="{{auth()->user()->saldo}}">
                                <div class="row">
                                    <div class="left-side col-md-6">
                                        <span class="bet-place"></span>
                                        <span class="bet-price">
                                        <label> Selecione o conjunto vencedor</label>
                                        <select name="conjuntoSelecionado" class="form-control formulario" @if (Carbon\Carbon::parse($prova->dataProva)->isPast()) disabled @endif required>
                                            <option value="" selected disabled>-- Selecione --</option>

                                            @foreach ($prova->conjuntos->sortBy('ordem') as $conjunto)
                                            <option value="{{$conjunto->idProvaConjunto}}">{{$conjunto->nomeConjunto}} ({{number_format(($prova->saldoAcumulado + ($prova->valor * 1)) / ((\App\Models\Apostas::where('idProva', $prova->idProva)->where('ConjuntoEscolhido', $conjunto->idProvaConjunto)->sum('qtdeCotas') + 1) * $prova->valor), 2, '.')}}x)</option>
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
                                                <button type="button" class="btn btn-outline-secondary btn-number" disabled="disabled" data-type="minus" data-field="qtdCotas">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="qtdCotas" class="form-control input-number" value="1" min="1" max="99" style="text-align: center;" @if (Carbon\Carbon::parse($prova->dataProva)->isPast()) disabled @endif required>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" @if (Carbon\Carbon::parse($prova->dataProva)->isPast()) disabled @endif data-field="qtdCotas">
                                                    <span class="fa fa-plus"></span>
                                                </button>

                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="padding-top: 7px">
                                        <a id="totalPalpiteValor">R$ {{number_format($prova->valor, 2, ".", " ")}}</a>
                                    </div>
                                </div>

                                <div class="row" align="center">
                                    <div class="right-side">

                                        <br>
                                        <div class="buttons">
                                            @if (Carbon\Carbon::parse($prova->dataProva)->isPast() || $prova->situacao != 1)
                                                <button id="palpite_btn" class="btn btn-danger bet-btn-dark-light" disabled>
                                                    <i class="fa fa-ban"></i> Apostas Encerradas
                                                </button>
                                            @else
                                            <button type="submit" id="palpite_btn" type="button" class="btn btn-warning bet-btn-dark-light">
                                                <i class="fa fa-plus"></i> Apostar
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <small>
                            O percentual refere-se a quantidade de apostas feitas em cada conjunto até o momento.
                        </small>

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
