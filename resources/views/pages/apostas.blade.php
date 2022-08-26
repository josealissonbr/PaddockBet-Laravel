@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>Apostas</h3>
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
                                <th scope="col">Situação	</th>
                                <th scope="col">Pontos</th>
                                <th scope="col">Prêmio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/08/2022</td>
                                 <td><a href="detalheBilhete.php">#123456</a></td>
                                <th scope="row" class="d-flex"><a href="prova.php?id=1"?>Campeonato Brasileiro Série Especial</a></th>
                               <td>18/08/2022</td>

                                <td>Aguardando Prova</td>
                                <td>0</td>
                                <td>R$ 0,00</td>
                            </tr>
                              <tr>
                                <td>15/08/2022</td>
                                 <td>#123458</td>
                                <th scope="row" class="d-flex"><a href="prova.php?id=1"?>Campeonato Brasileiro Série Especial</a></th>
                               <td>18/08/2022</td>

                                <td>Aguardando Prova</td>
                                <td>0</td>
                                 <td>R$ 0,00</td>
                            </tr>
                              <tr>
                                <td>15/08/2022</td>
                                 <td>#123459</td>
                               <th scope="row" class="d-flex"><a href="prova.php?id=1"?>Campeonato Brasileiro Série Especial</a></th>
                               <td>18/08/2022</td>

                                <td>Aguardando Prova</td>
                                <td>0</td>
                                 <td>R$ 0,00</td>
                            </tr>
                              <tr>
                                <td>15/08/2022</td>
                                 <td>#123456</td>
                               <th scope="row" class="d-flex"><a href="prova.php?id=1"?>Campeonato Brasileiro Série Especial</a></th>
                               <td>18/08/2022</td>

                                <td>Finalizado</td>
                                <td>11</td>
                                 <td>R$ 0,00</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
