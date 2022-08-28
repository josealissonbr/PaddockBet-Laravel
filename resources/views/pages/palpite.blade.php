@extends('layouts.app')


@section('content')
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>20/08/2022 Campeonato Brasileiro - Etapa Maceió</h3>
                    <h3>Faça sua aposta: </h3>
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
                        <div class="different-bet">

                            <div class="single-bet">

                                <div class="left-side">
                                    <span class="bet-place">20/08/2022  - Série Aspirante</span>
                                    <span class="bet-price">0.90m</span>
                                </div>



                            </div>
                           <form action="apostas.php">
                            <div class="row">
                                <div class="left-side">
                                    <span class="bet-place"></span>
                                    <span class="bet-price">
                                       <label style="margin-left: 12px"> 1º Colocado:  </label>
                                       <select name="p1" class="formulario">
                                         <option value="0">Selecione</option>
                                            <option value="1">Fulano de Tal/Cavalo 1</option>
                                             <option value="2">Jose da Silva/Cavalo 2</option>
                                              <option value="3">Antonio Costa/Cavalo 3</option>
                                               <option value="4">Carlos Oliveira/Cavalo 4</option>
                                                <option value="5">Daniel Fernandes/Cavalo 5</option>
                                            </select>
                                            12 pontos
                                     </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="left-side">
                                    <span class="bet-place"></span>
                                    <span class="bet-price">
                                       <label style="margin-left: 12px"> 2º Colocado:  </label>
                                       <select name="p1" class="formulario">
                                         <option value="0">Selecione</option>
                                            <option value="1">Fulano de Tal/Cavalo 1</option>
                                             <option value="2">Jose da Silva/Cavalo 2</option>
                                              <option value="3">Antonio Costa/Cavalo 3</option>
                                               <option value="4">Carlos Oliveira/Cavalo 4</option>
                                                <option value="5">Daniel Fernandes/Cavalo 5</option>
                                            </select>
                                                 8 pontos
                                     </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="left-side">
                                    <span class="bet-place"></span>
                                    <span class="bet-price">
                                       <label style="margin-left: 12px"> 3º Colocado:  </label>
                                       <select name="p1" class="formulario">
                                         <option value="0">Selecione</option>
                                            <option value="1">Fulano de Tal/Cavalo 1</option>
                                             <option value="2">Jose da Silva/Cavalo 2</option>
                                              <option value="3">Antonio Costa/Cavalo 3</option>
                                               <option value="4">Carlos Oliveira/Cavalo 4</option>
                                                <option value="5">Daniel Fernandes/Cavalo 5</option>
                                            </select>
                                             7 pontos
                                     </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="left-side">
                                    <span class="bet-place"></span>
                                    <span class="bet-price">
                                       <label style="margin-left: 12px"> 4º Colocado:  </label>
                                       <select name="p1" class="formulario">
                                         <option value="0">Selecione</option>
                                            <option value="1">Fulano de Tal/Cavalo 1</option>
                                             <option value="2">Jose da Silva/Cavalo 2</option>
                                              <option value="3">Antonio Costa/Cavalo 3</option>
                                               <option value="4">Carlos Oliveira/Cavalo 4</option>
                                                <option value="5">Daniel Fernandes/Cavalo 5</option>
                                            </select>
                                             6 pontos
                                     </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="left-side">
                                    <span class="bet-place"></span>
                                    <span class="bet-price">
                                       <label style="margin-left: 12px"> 5º Colocado:  </label>
                                       <select name="p1" class="formulario">
                                         <option value="0">Selecione</option>
                                            <option value="1">Fulano de Tal/Cavalo 1</option>
                                             <option value="2">Jose da Silva/Cavalo 2</option>
                                              <option value="3">Antonio Costa/Cavalo 3</option>
                                               <option value="4">Carlos Oliveira/Cavalo 4</option>
                                                <option value="5">Daniel Fernandes/Cavalo 5</option>
                                            </select>
                                             5 pontos
                                     </span>
                                </div>
                            </div>

                            <div class="row" align="center">
                                <div class="right-side">
                                    <br>
                                    <div class="buttons">

                                            <a href="apostas.php?idProva=1" class="buy-ticket bet-btn bet-btn-dark-light"><i class="fa fa-save"></i> Fazer Palpite</a>
                                     </div>

                                </div>
                            </div>

                            </form>
                        </div>










                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bet-slip-sidebar">

                    <h4 class="title">Campeonato Brasileiro - Etapa Maceió</h4>
                    <h3 class="title" style="text-align:  center">Série Aspirante  0.90m</h4>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <span class="title">Início</span>
                                <span class="number">20/06/2022</span>
                            </li>
                            <li>
                                <span class="title">Valor Por Palpite</span>
                                <span class="number">R$ 20,00<span>
                            </li>
                        </ul>
                        <div class="total-returns">
                            <span class="text">
                                Prêmio Total desta prova
                            </span>
                            <span class="number">
                                R$ 9.500
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
