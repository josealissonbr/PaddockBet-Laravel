<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{env('APP_NAME')}}</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- fontawesome icon  -->
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
        <!-- flaticon css -->
        <link rel="stylesheet" href="assets/fonts/flaticon.css">
        <!-- animate.css -->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/odometer.min.css">
        <!-- stylesheet -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- responsive -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/register-page-responsive.css">
    </head>

    <body>

        <!-- preloader begin -->
        <div class="preloader">
            <img src="assets/img/preloader.gif" alt="">
            <span>CARREGANDO</span>
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
                                           FAZER LOGIN
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
                                            <img src="{{asset('assets/img/logo.png')}}" alt="logo">
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


        <!-- login begin -->
        <div class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-8">
                        <div class="section-title">
                            <h2>Paddock.Bet</h2>
                            <p>Insira suas credenciais.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div class="login-form">
                            <form action="{{route('login.post')}}" method="POST">
                                @csrf

                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div>
                                    <span class="text-danger">{{ $error }}</span>
                                </div>
                                @endforeach
                            @endif

                                @if ($errors->has('email'))
                                <div>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                @endif
                                <input type="email" name="email" placeholder="Insira seu email">

                                @if ($errors->has('email'))
                                <div>
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                </div>
                                @endif
                                <input type="password" name="password" placeholder="Insira sua senha">

                                <div class="row justify-content-center">
                                    <button type="submit" class="align-middle">Login</button>
                                </div>
                                <div class="row">
                                    <a href="{{route('login.cadastro')}}" style="margin-left: 10px;">Cadastrar</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login end -->

         <!-- footer begin -->
         <div class="footer" id="contact">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-10">
                        <div class="about-widget">
                            <a class="logo" href="index.html">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                            <p>PerediOn offers you all the best online prediction from every corner of the planet with thousands of online prediction markets.</p>
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
                                            <img src="assets/img/svg/email.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">E-mail</span>
                                            <span class="descr">suporte@paddock.bet</span>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <img src="assets/img/svg/phone-call.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">Telefone</span>
                                            <span class="descr">+155000000000</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">
                            <h3>Useful links</h3>
                            <ul>
                                <li>
                                    <a href="#">IN-PLAY</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                    {{--<div class="col-xl-2 col-lg-3 col-md-3">
                        <div class="useful-links">
                            <h3>Connect With Us</h3>
                            <ul>
                                <li>
                                    <a href="#">About Us</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                    {{--<div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="useful-links">
                            <h3>All Sports</h3>
                            <ul>
                                <li>
                                    <a href="#">FOOTBALL</a>
                                </li>

                            </ul>
                        </div>
                    </div>--}}
                </div>
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="payment-method">
                                    <h6 class="payment-method-title">
                                        Métodos de pagamentos aceitos
                                    </h6>
                                    <div class="all-method">
                                        <div class="single-method">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg" alt="">
                                        </div>
                                        {{--<div class="single-method">
                                            <img src="assets/img/brand-2.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-3.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-4.png" alt="">
                                        </div>
                                        <div class="single-method">
                                            <img src="assets/img/brand-5.png" alt="">
                                        </div>

                                        <div class="single-method">
                                            <img src="assets/img/brand-5.png" alt="">
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
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
                        PaddockBet &copy; {{Carbon\Carbon::now()->format('Y')}} |  Todos os direitos reservados.
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
                            <a href="#">Paddock</a> © 2020. PRIVACY POLICY
                        </p>
                    </div>
                    <div class="text-right col-md-6 col-xl-4 col-lg-6 d-xl-flex d-lg-flex d-block align-items-center">
                        <p class="copyright-text">
                            Desenvolvido com <i class="fa fa-heart" style="color: #ff0000"></i> por <a href="https://www.linkedin.com/in/alisson-santos-9332b7219/" target="_blank" style="text-decoration: underline;">Alisson Santos</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright footer end -->

        <!-- jquery -->
        <!-- <script src="assets/js/jquery.js"></script> -->
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <!-- bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- owl carousel -->
        <script src="assets/js/owl.carousel.js"></script>
        <!-- magnific popup -->
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <!-- filterizr js -->
        <script src="assets/js/jquery.filterizr.min.js"></script>
        <!-- wow js-->
        <script src="assets/js/wow.min.js"></script>
        <!-- clock js -->
        <script src="assets/js/clock.min.js"></script>
        <script src="assets/js/jquery.appear.min.js"></script>
        <script src="assets/js/odometer.min.js"></script>
        <!-- main -->
        <script src="assets/js/main.js"></script>
    </body>
</html>
