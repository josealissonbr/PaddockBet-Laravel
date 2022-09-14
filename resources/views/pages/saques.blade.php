@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title ">
                    <h3 class="">Saques</h3>
                    <a href="{{route('dashboard.saques.novo')}}" class="vew-more-news bet-btn bet-btn-dark-light offset-sm-6">
                        <i class="fas fa-redo"></i> Novo Saque
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
                            @foreach ($saques as $saque)
                            <tr>
                                <td>#{{$saque->id}}</td>
                                 <td>Pix</td>
                                <th scope="row" class="d-flex">
                                    R$ {{number_format($saque->valor, 2, ',', ' ')}}
                                </th>
                                <td>
                                    @php
                                    if ($saque->situacao == 0)
                                        echo "Pendente";
                                    else if ($saque->situacao == 1)
                                        echo "Processado";
                                    else if ($saque->situacao == 2)
                                        echo "Cancelado";
                                    else if ($saque->situacao == 3)
                                        echo "Falha";
                                    else
                                        echo "Desconhecido";
                                @endphp
                                </td>
                                <td>{{Carbon\Carbon::parse($saque->created_at)->format('d/m/Y H:i')}}</td>
                                <td>{{Carbon\Carbon::parse($saque->updated_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    <a href="javascript:void(0)">
                                        Ver Comprovante
                                    </a>
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
@endsection
