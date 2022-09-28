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
                        <h4>Provas</h4>
                        <h4></h4>
                    </div>
                    <div>
                        @foreach ($provas as $prova)
                        <div class="different-bet">
                            <div class="single-bet">
                                <div class="left-side">
                                    <span class="bet-place">{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y h:i')}}  - {{$prova->nomeProva}}</span>
                                    <span class="bet-price">{{$prova->altura}}</span>
                                </div>
                                <div class="right-side">
                                    <div class="buttons">
                                        <a href="{{route('dashboard.provas.palpite', $prova->idProva)}}" class="buy-ticket bet-btn bet-btn-dark-light"><i class="fa fa-plus"></i> Fazer Palpite</a>
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
                    <h4 class="title">{{$prova->nomeProva}}</h4>
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
                        <div class="total-returns">
                            <span class="text">
                                Prêmio Total deste Evento
                            </span>
                            <span class="number">
                                R$ {{number_format($acumuladoEvento, 2, ",", " ")}}
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
