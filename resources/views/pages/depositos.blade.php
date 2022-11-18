@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title ">
                    <h3 class="">Depósitos</h3>
                    <a href="{{route('dashboard.depositos.novo')}}" class="vew-more-news bet-btn bet-btn-dark-light offset-sm-6">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($depositos as $deposito)
                            <tr>
                                <td>{{$deposito->id}}</td>
                                 <td>Pix</td>
                                <th scope="row" class="d-flex">
                                    R$ {{number_format($deposito->valor, 2, ',', ' ')}}
                                </th>
                                <td>
                                    @php
                                        if ($deposito->situacao == 0)
                                            echo "Pendente";
                                        else if ($deposito->situacao == 1)
                                            echo "Pago";
                                        else if ($deposito->situacao == 2)
                                            echo "Cancelado";
                                        else if ($deposito->situacao == 3)
                                            echo "Falha";
                                        else
                                            echo "Desconhecido ";
                                    @endphp
                                </td>
                                <td>{{Carbon\Carbon::parse($deposito->created_at)->format('d/m/Y H:i')}}</td>
                                <td>{{Carbon\Carbon::parse($deposito->updated_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    @if ($deposito->situacao == 0)
                                    <a href="{{route('dashboard.depositos.pagar', $deposito->id)}}">
                                        <span class="view-icon">
                                            <i class="fas fa-qrcode"></i> Pagar
                                        </span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center" style="padding-top: 10px">
                        {{$depositos->links()}}
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
