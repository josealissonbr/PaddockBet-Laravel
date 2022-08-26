<?php
ini_set('display_errors', 0);
?><!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paddock Bet</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <!-- fontawesome icon  -->
        <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
        <!-- flaticon css -->
        <link rel="stylesheet" href="../assets/fonts/flaticon.css">
        <!-- animate.css -->
        <link rel="stylesheet" href="../assets/css/animate.css">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/css/odometer.min.css">
        <!-- stylesheet -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- responsive -->
        <link rel="stylesheet" href="../assets/css/responsive.css">
        <link rel="stylesheet" href="../assets/css/dashboard-responsive.css">
    </head>

    <body>

        <!-- preloader begin -->
        <div class="preloader">
            <img src="../assets/img/preloader.gif" alt="">
            <span>PaddockBet</span>
        </div>
        <!-- preloader end -->

        <!-- header begin -->
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6">
                            <div class="left-area">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        <span class="text">
                                            <span id="date"></span>
                                            <span id="month"></span>
                                            <span id="year"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-clock"></i>
                                        </span>
                                        <span class="text clocks">
                                            <span id="hours"></span>:<span id="minutes"></span>:<span id="seconds"></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6">
                            <div class="right-area">
                                <ul>


                                    <li>
                                        <a class="link" href="#">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 fa-fw fa-2x"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm128 421.6c-35.9 26.5-80.1 42.4-128 42.4s-92.1-15.9-128-42.4V416c0-35.3 28.7-64 64-64 11.1 0 27.5 11.4 64 11.4 36.6 0 52.8-11.4 64-11.4 35.3 0 64 28.7 64 64v13.6zm30.6-27.5c-6.8-46.4-46.3-82.1-94.6-82.1-20.5 0-30.4 11.4-64 11.4S204.6 320 184 320c-48.3 0-87.8 35.7-94.6 82.1C53.9 363.6 32 312.4 32 256c0-119.1 96.9-216 216-216s216 96.9 216 216c0 56.4-21.9 107.6-57.4 146.1zM248 120c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 144c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z" class=""></path></svg>
                                           Eric Martins
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="navbar" class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-block align-items-center">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-6 d-xl-block d-lg-block d-flex align-items-center">
                                    <div class="logo">
                                        <a href="index.php">
                                            <img src="../assets/img/logo.png" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 d-xl-none d-lg-none d-block">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="mainmenu">
                                <nav class="navbar navbar-expand-lg">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                    </div>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header end -->

        <div class="user-panel-dashboard">

            <!-- user panel header begin -->
            @include('layouts.header')
            <!-- user panel header end -->

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
                                    <span class="number">R$ 900</span>
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
                                    <span class="number">R$ 300</span>
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
                                    <span class="number">R$230</span>
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
                                    <span class="number">R$ 0</span>
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
        </div>

        <!-- footer begin -->
        <div class="footer" id="contact">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-10">
                        <div class="about-widget">
                            <a class="logo" href="index.html">
                                <img src="../assets/img/logo.png" alt="">
                            </a>
                            <p>Riders Bet: Seu site de apostas em Saltos</p>
                            <div class="social">
                                <ul>
                                    <li>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-pinterest-p"></i>
                                        </a>
                                        <a href="#" class="social-icon">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="support">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <img src="../assets/img/svg/email.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">E-mail</span>
                                            <span class="descr">suporte@ridersbet.com</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <img src="../assets/img/svg/phone-call.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">Phone</span>
                                            <span class="descr">+155000000000</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">

                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3">
                        <div class="useful-links">

                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer end -->

        <!-- notes begin -->
        <div class="notes">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10">
                        Ridersbet © 2022.
                    </div>
                </div>
            </div>
        </div>
        <!-- notes end -->

        <!-- copyright footer begin -->
        <div class="copyright-footer">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-md-6 col-lg-6 d-lg-flex d-lg-flex d-block align-items-center">
                        <p class="copyright-text">
                            <a href="#">RidersBet</a> © 2022. POLÍTICA DE PRIVACIDADE
                        </p>
                    </div>
                    <div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                        <p class="copyright-text">

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright footer end -->

        <!-- jquery -->
        <!-- <script src="assets/js/jquery.js"></script> -->
        <script src="../assets/js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- owl carousel -->
        <script src="../assets/js/owl.carousel.js"></script>
        <!-- magnific popup -->
        <script src="../assets/js/jquery.magnific-popup.js"></script>
        <!-- filterizr js -->
        <script src="../assets/js/jquery.filterizr.min.js"></script>
        <!-- wow js-->
        <script src="../assets/js/wow.min.js"></script>
        <!-- clock js -->
        <script src="../assets/js/clock.min.js"></script>
        <script src="../assets/js/jquery.appear.min.js"></script>
        <script src="../assets/js/odometer.min.js"></script>
        <!-- chart js -->
        <script src="../assets/js/Chart.min.js"></script>
        <script src="../assets/js/chart-activate.js"></script>
        <script src="../assets/js/utils.js"></script>
        <!-- main -->
        <script src="../assets/js/main.js"></script>
    </body>
</html>
