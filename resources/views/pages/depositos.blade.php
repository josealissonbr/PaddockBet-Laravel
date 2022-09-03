@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title ">
                    <h3 class="">Depósitos</h3>
                    <a href="#" class="vew-more-news bet-btn bet-btn-dark-light offset-sm-6">
                        <i class="fas fa-redo"></i> Novo Depósito
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
                                <th scope="col">#ID</th>
                                <th scope="col">Método</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Data Criação</th>
                                <th scope="col">Última atualização</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transacoes as $transacao)
                            <tr>
                                <td>#{{$transacao->idTransacao}}</td>
                                 <td>Pix</td>
                                <th scope="row" class="d-flex">
                                    R$ {{number_format($transacao->valor, 2, ',', ' ')}}
                                </th>
                                <td>
                                    @php
                                    if ($transacao->situacao == 1)
                                        echo "Processado";
                                    else if ($transacao->situacao == 2)
                                        echo "Cancelado";
                                    else if ($transacao->situacao == 3)
                                        echo "Falha";
                                    else if ($transacao->situacao == 4)
                                        echo "Reembolso";
                                    else
                                        echo "Desconhecido";
                                @endphp
                                </td>
                                <td>{{Carbon\Carbon::parse($transacao->created_at)->format('d/m/Y h:i')}}</td>
                                <td>{{Carbon\Carbon::parse($transacao->updated_at)->format('d/m/Y h:i')}}</td>
                                <td></td>
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
