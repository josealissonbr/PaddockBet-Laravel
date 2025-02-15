@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title ">
                    <h3 class="">Apostas</h3>
                    <a href="{{route('dashboard.eventos')}}" class="vew-more-news bet-btn bet-btn-dark-light offset-sm-6">
                        <i class="fas fa-redo"></i> Nova Aposta
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="transaction-area">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Data Aposta</th>
                                <th scope="col">Codigo Bilhete	</th>
                                <th scope="col">Prova</th>
                                <th scope="col">Data Prova</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Cotas</th>
                                <th scope="col">Resultado</th>
                                <th scope="col">Prêmio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apostas as $aposta)
                            <tr>
                                <td>{{Carbon\Carbon::parse($aposta->created_at)->format('d/m/Y H:i')}}</td>
                                 <td><a href="detalheBilhete.php">{{$aposta->idAposta}}</a></td>
                                <th scope="row" class="d-flex">
                                    <a href="{{route('dashboard.apostas.detalhes', $aposta->idAposta)}}">{{isset($aposta->prova->evento->nomeEvento) ? $aposta->prova->evento->nomeEvento : ''}} - {{isset($aposta->prova->nomeProva) ? $aposta->prova->nomeProva : ''}}</a></th>
                               <td>{{isset($aposta->prova->dataProva) ? Carbon\Carbon::parse($aposta->prova->dataProva)->format('d/m/Y H:i') : ''}}</td>

                                <td>
                                    @php
                                        if(isset($aposta->prova->dataProva)){
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
                                        }
                                    @endphp
                                </td>
                                <td>{{$aposta->qtdeCotas}}</td>
                                <td>@php
                                    if (isset($aposta->prova->situacao )){
                                        if ($aposta->prova->situacao == 3){
                                            if ($aposta->resultado == 1){
                                                echo "<a style='color: green'>Ganhou</a>";
                                            }else{
                                                echo "<a style='color: red'>Perdeu</a>";
                                            }
                                        }else{
                                            echo "N/A";
                                        }
                                    }
                                @endphp</td>
                                <td>R$ {{number_format($aposta->premio, 2, ',', ' ')}}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
