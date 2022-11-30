@extends('layouts.app')

@section('content')
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>{{$evento->nomeEvento}}</h3>
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
                        <h4>Provas Ativas</h4>
                        <h4></h4>
                    </div>
                    <div>
                        @foreach ($provas->filter(function ($item) {
                            return $item->situacao==1;
                        })->values() as $prova)
                        <div class="different-bet">
                            <div class="single-bet">
                                <div class="left-side">
                                    <span class="bet-place">
                                        {{$prova->nomeProva}}
                                        <span class="table-sub-date">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i')}}</span>
                                    </span>
                                    <span class="bet-price">{{$prova->altura}}</span>
                                </div>
                                <div class="right-side">
                                    <div class="buttons">
                                        <button onclick="window.location.href='{{route('dashboard.provas.palpite', $prova->idProva)}}'" class="btn btn-warning bet-btn-dark-light"><i class="fa fa-plus"></i> Apostar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bet-slip-sidebar">
                    <h4 class="title">{{isset($evento->nomeEvento) ? $evento->nomeEvento : ''}}</h4>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <span class="title">Cidade</span>
                                <span class="number">{{ucfirst($evento->cidade)}}</span>
                            </li>
                            <li>
                                <span class="title">Situação</span>
                                <span class="number">@php
                                    if ($evento->situacao == 1)
                                        echo "Ativo";
                                    elseif ($evento->situacao == 0)
                                        echo "Inativo";
                                @endphp<span>
                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 result pt-2">
                <div class="result-sheet-cover">
                    <div class="result-sheet">
                        <h4 class="result-title">Resultados</h4>
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Data &amp; Hora</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Vencedor</th>
                                    <th scope="col">Odds</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provas->SortByDesc('dataProva')->filter(function ($item) {
                                    return $item->situacao==3;
                                })->values() as $prova)

                                <tr style="background: #111618; border: 1px solid rgba(248, 27, 100, 0.4);">

                                    <td class="text-light">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i')}} </td>
                                    <td class="text-light">{{$prova->nomeProva}}</td>
                                    <td class="text-light"> {{!is_null($prova->conjuntoVencedor->nomeConjunto) ? $prova->conjuntoVencedor->nomeConjunto : 'N/A'}}</td>

                                    <td class="text-light">
                                        @php
                                            $qtdCotas = \App\Models\Apostas::where('idProva', $prova->idProva)->where('ConjuntoEscolhido', $prova->idConjuntoVencedor)->sum('qtdeCotas');

                                            if ($qtdCotas < 1)
                                                $qtdCotas = 1;

                                            echo number_format(($prova->saldoAcumulado) / ($qtdCotas * $prova->valor), 2, '.');
                                        @endphp
                                        x
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- bet-slip end -->
@endsection
