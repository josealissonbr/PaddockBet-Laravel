@extends('layouts.app')


@section('content')




    <!-- chart begin -->
<div class="chart-section">
    <div class="container">
        <div class="row justify-content-end">
            {{--<div class="col-xl-4 col-lg-4">
                <div class="user-panel-title">
                    <h3>Histórico</h3>
                </div>
                <div class="account-info">
                    <ul>
                        <li>
                            <span class="title">Cadastro</span>
                            <span class="details"> {{Carbon\Carbon::parse(auth()->user()->created_at)->format('d/m/Y H:i')}}</span>
                        </li>
                        <li>
                            <span class="title">Acesso Atual </span>
                            <span class="details"> @if (\App\Models\authenticationLogs::where('idCliente', auth()->user()->id)->count() > 0) {{Carbon\Carbon::parse((\App\Models\authenticationLogs::where('idCliente', auth()->user()->id)->get()->last())->created_at)->format('d/m/Y H:i')}} @else Desconhecido @endif </span>
                        </li>
                        <li>
                            <span class="title">IP Acesso Atual</span>
                            <span class="details"> @if (\App\Models\authenticationLogs::where('idCliente', auth()->user()->id)->count() > 0) {{(\App\Models\authenticationLogs::where('idCliente', auth()->user()->id)->get()->last())->ip}} @else Desconhecido @endif </span>
                        </li>
                    </ul>
                </div>
            </div>--}}
            <div class="col-xl-12 col-lg-12">
                <div class="user-panel-title">
                    <h3>Eventos</h3>
                </div>
                <div class="standing" style="padding: 0px 0px;">
                    <div class="standing-list-cover">
                        <div class="standing-team-list">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Pos</th>
                                        <th scope="col">Evento</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">Situação</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Eventos::where('situacao', 1)->get() as $key=>$evento)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td><a href="{{route('dashboard.provas', $evento->idEvento)}}">
                                            <span class="single-team">

                                                <span class="text">
                                                    {{$evento->nomeEvento}}
                                                </span>
                                            </span>
                                            </a>
                                        </td>
                                        <td>{{$evento->cidade}}</td>
                                        <td>
                                            @php
                                            if ($evento->situacao == 0)
                                                echo "Inativo";
                                            else if ($evento->situacao == 1)
                                                echo "Ativo";
                                            else if ($evento->situacao == 2)
                                                echo "Cancelado";
                                            @endphp
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
</div>
<!-- chart end -->



<!-- user-statics begin -->
<div class="player-statics">
    <div class="container">
        {{--<div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="user-panel-title">
                    <h3>Minha Conta</h3>
                </div>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-static">
                    <div class="part-icon">
                        <img src="../assets/img/svg/money1.svg" alt="">
                    </div>
                    <div class="part-text">
                        <span class="number">R$ {{number_format(auth()->user()->saldo, 2    , ",", ".")}}</span>
                        <span class="title">Saldo Disponível</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-static">
                    <div class="part-icon">
                        <img src="../assets/img/svg/payment.svg" alt="">
                    </div>
                    <div class="part-text">
                        <span class="number">R$ {{number_format($emApostas, 2    , ",", ".")}}</span>
                        <span class="title">Em Apostas</span>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-static">
                    <div class="part-icon">
                        <img src="../assets/img/svg/transfer1.svg" alt="">
                    </div>
                    <div class="part-text">
                        <span class="number">R$ {{number_format($emTransferencia, 2    , ",", ".")}}</span>
                        <span class="title">Em Transferência</span>
                    </div>
                </div>
            </div>

             <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-static">
                    <div class="part-icon">
                        <img src="../assets/img/svg/money2.svg" alt="">
                    </div>
                    <div class="part-text">
                        <span class="number">R$ {{number_format(0.00, 2    , ",", ".")}}</span>
                        <span class="title">Bônus</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- user-statics end -->

<!-- payment history begin -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>Transações</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="transaction-area">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipo de Transação</th>
                                <th scope="col">#ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transacoes as $transacao)
                            <tr>
                                <th scope="row" class="d-flex">@php
                                    if ($transacao->tipo == 1)
                                        echo "Depósito";
                                    else if ($transacao->tipo == 2)
                                        echo "Aposta";
                                    else if ($transacao->tipo == 3)
                                        echo "Saque";
                                    else if ($transacao->tipo == 4)
                                        echo "Receb. Aposta";
                                    else if ($transacao->tipo == 5)
                                        echo "Bônus";
                                @endphp</th>
                                <td>#{{$transacao->idTransacao}}</td>
                                <td>{{Carbon\Carbon::parse($transacao->created_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    @php
                                    if ($transacao->situacao == 0)
                                        echo "Pendente";
                                    else if ($transacao->situacao == 1)
                                        echo 'Pago';
                                    else if ($transacao->situacao == 2)
                                        echo "Cancelado";
                                @endphp
                                </td>
                                <td style="color: @php if ($transacao->tipo == 2 || $transacao->tipo == 3) {
                                    echo "red;";
                                }else echo "green;"; @endphp">@php if ($transacao->tipo == 2 || $transacao->tipo == 3) {
                                    echo "-";
                                }else echo "+"; @endphpR$ {{number_format($transacao->valor, 2    , ",", ".")}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center align-items-center" style="padding-top: 20px">

                    {{$transacoes->links()}}

                    {{--<a href="javascript:void;" class="vew-more-news bet-btn bet-btn-base">
                        <i class="fas fa-redo"></i> Carregar mais
                    </a>--}}
                </div>

            </div>

        </div>
    </div>
</div>
<!-- payment history end -->

@endsection
