@extends('layouts.app')

@section('content')
 <!-- chart end -->
        <!-- Historico de Apostas -->
        <div class="payment-history">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="user-panel-title">
                            <h3>{{$aposta->prova->evento->nomeEvento}} - {{$aposta->prova->nomeProva}}</h3>
                            <h3>Detalhes da Sua Aposta </h3>
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
                                <h4>Detalhes da Aposta</h4>
                                <h4></h4>
                            </div>
                            <div>
                                <div class="different-bet">

                                    <div class="single-bet">

                                        <div class="left-side">
                                            <span class="bet-place">{{$aposta->prova->nomeProva}}</span>
                                            <span class="bet-price">{{$aposta->prova->altura}}</span>
                                        </div>



                                    </div>
                                   <form action="apostas.php">
                                        <div class="row">
                                            <div class="left-side">
                                                <span class="bet-place"></span>
                                                <span class="bet-price">
                                                <label style="margin-left: 12px"> 1º Colocado:  </label>
                                                <b>{{$aposta->conjuntoSelecionado->nomeConjunto}}</b>
                                                </span>
                                            </div>
                                        </div>
                                        Situação: @php
                                        if ($aposta->prova->situacao == 0)
                                            echo "Inativo";
                                        else if ($aposta->prova->situacao == 1)
                                            echo "Recebendo Apostas";
                                        else if ($aposta->prova->situacao == 2)
                                            echo "Aguardando Prova";
                                        else if ($aposta->prova->situacao == 3)
                                            echo "Finalizado";
                                        else if ($aposta->prova->situacao == 4)
                                            echo "Cancelado";
                                    @endphp

                                        @php
                                        if ($aposta->prova->situacao == 3){
                                            echo "<br> Resultado: ";

                                            if ($aposta->resultado == 1){
                                                echo "<a style='color:green'>Venceu</a>";
                                                echo "<br> Total ganho: R$ ".number_format($aposta->premio, 2, ',', ' ')    ;
                                            }else{
                                                echo "<a style='color:red'>Perdeu</a>";
                                            }
                                        }

                                        @endphp
                                        <br>
                                    {{--<img src="{{asset('valida.png')}}">--}}
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="bet-slip-sidebar">

                            <h4 class="title">{{$aposta->prova->evento->nomeEvento}}</h4>
                            <h3 class="title" style="text-align:  center">{{$aposta->prova->nomeProva}}</h4>
                            <div class="sidebar-content">
                                <ul>
                                    <li>
                                        <span class="title">Início</span>
                                        <span class="number">{{Carbon\Carbon::parse($aposta->created_at)->format('d/m h:i')}}</span>
                                    </li>
                                    <li>
                                        <span class="title">Valor da Aposta</span>
                                        <span class="number">R$ {{number_format($aposta->valorAposta, 2, ',', ' ')}}<span>
                                    </li>
                                </ul>
                                <div class="total-returns">
                                    <span class="text">
                                        Prêmio Total desta prova
                                    </span>
                                    <span class="number">
                                        R$ {{number_format($aposta->prova->saldoAcumulado, 2, ',', ' ')}}
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
