@extends('layouts.app')


@section('content')
<!-- user-statics begin -->
 <div class="player-statics">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="user-panel-title">
                    <h3>Minha Conta</h3>
                </div>
            </div>
        </div>
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
                        <span class="number">R$ {{number_format(0.00, 2    , ",", ".")}}</span>
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
                        <span class="number">R$ {{number_format(0.00, 2    , ",", ".")}}</span>
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

<!-- chart begin -->
<div class="chart-section">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-4 col-lg-4">
                <div class="user-panel-title">
                    <h3>Histórico</h3>
                </div>
                <div class="account-info">
                    <ul>
                        <li>
                            <span class="title">Cadastro</span>
                            <span class="details"> 01/07/2022 11:20:37</span>
                        </li>
                        <li>
                            <span class="title">Último Acesso</span>
                            <span class="details">  03/07/2022 07:06:36</span>
                        </li>
                        <li>
                            <span class="title">Acesso Atual </span>
                            <span class="details"> 18/07/2022 02:47:23</span>
                        </li>
                        <li>
                            <span class="title">IP do Último Acesso</span>
                            <span class="details">  27.57.18.1</span>
                        </li>
                        <li>
                            <span class="title">IP Acesso Atual</span>
                            <span class="details"> 122.175.131.51</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>Histórico de Saldo</h3>
                </div>
                <canvas id="chart-0" height="168"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- chart end -->

<!-- payment history begin -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>Histórico de Saldo</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="transaction-area">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipo e Transação</th>
                                <th scope="col">Codigo Operação	</th>
                                <th scope="col">Data</th>
                                <th scope="col">Método	</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="d-flex">Depósitos</th>
                                <td>X N 0465 4364 74 457</td>
                                <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>

                            <tr>
                                <th scope="row" class="d-flex">Solicitação Resgate</th>
                                <td>X N 0465 4364 74 457</td>
                                 <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>

                            <tr>
                                <th scope="row" class="d-flex">Saque Confirmado</th>
                                <td>X N 0465 4364 74 457</td>
                                 <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>

                            <tr>
                                <th scope="row" class="d-flex">Depósitos</th>
                                <td>X N 0465 4364 74 457</td>
                                <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>

                            <tr>
                                <th scope="row" class="d-flex">Solicitação Resgate</th>
                                <td>X N 0465 4364 74 457</td>
                                <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex">Saque Confirmado</th>
                                <td>X N 0465 4364 74 457</td>
                               <td>18/07/2022</td>
                                <td>Pix</td>
                                <td>R$ 300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- payment history end -->

@endsection
