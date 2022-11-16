<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>{{env('APP_NAME')}}</title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('admin-assets/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('admin-assets/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('admin-assets/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('admin-assets/img/apple-touch-icon-144x144-precomposed.png')}}">
    <!-- Bootstrap core CSS-->
    <link href="{{asset('admin-assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{asset('admin-assets/css/admin.css')}}" rel="stylesheet">

    <link href="{{asset('admin-assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{asset('admin-assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Plugin styles -->
    <link href="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Your custom styles -->
    <link href="{{asset('admin-assets/css/custom.css')}}">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{'admin.home'}}"><img src="{{asset('assets/img/logo.png')}}" alt="" width="122" height="36"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{route('admin.home')}}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings">
                        <i class="fa fa-fw fa-calendar"></i>
                        <span class="nav-link-text">Eventos</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseMylistings">
                        <li>
                            <a href="{{route('admin.eventos')}}">Todos os Eventos <span class="badge badge-pill badge-primary">{{\App\Models\Eventos::where('situacao', 1)->count()}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.eventos.novo')}}">Novo Evento</a>
                        </li>
                    </ul>
                </li>

                {{--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Provas">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProvas">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Provas</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseProvas">
                        <li>
                            <a href="{{route('admin.provas')}}">Todas as provas <span class="badge badge-pill badge-primary">{{\App\Models\Provas::where('situacao', 1)->count()}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.provas.novo')}}">Nova Prova</a>
                        </li>
                    </ul>
                </li>--}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Provas">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">Usuários</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseUsers">
                        <li>
                            <a href="{{route('admin.usuarios')}}">Todas os Usuários <span class="badge badge-pill badge-primary">{{\App\Models\User::count()}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.usuarios.novo')}}">Novo Usuário</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Provas">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSaques">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">Saques</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseSaques">
                        <li>
                            <a href="{{route('admin.saques.pendentes')}}">Saques Pendentes <span class="badge badge-pill badge-primary">{{\App\Models\Saques::where('situacao',0)->count()}}</span></a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Provas">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDepositos">
                        <i class="fa fa-fw fa-bank"></i>
                        <span class="nav-link-text">Depósitos</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseDepositos">
                        @if (auth()->user()->permission == 2)
                        <li>
                            <a href="{{route('admin.depositos')}}">Pendentes <span class="badge badge-pill badge-primary">{{\App\Models\Depositos::where('situacao',0)->count()}}</span></a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('admin.depositos.completos')}}">Efetuados <span class="badge badge-pill badge-primary">{{\App\Models\Depositos::where('situacao',1)->count()}}</span></a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transacoes">
                    <a class="nav-link" href="{{route('admin.transacoes')}}">
                        <i class="fa fa-fw fa-money"></i>
                        <span class="nav-link-text">Transações</span> <span class="badge badge-pill badge-primary">{{\App\Models\Transacoes::count()}}</span>
                    </a>
                </li>


            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                {{--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i>
                        <span class="d-lg-none">Messages
                            <span class="badge badge-pill badge-primary">12 New</span>
                        </span>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="d-lg-none">Alerts
                            <span class="badge badge-pill badge-warning">6 New</span>
                        </span>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">New Alerts:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-danger">
                                <strong>
                                    <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all alerts</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control search-top" type="text" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" {{--data-toggle="modal" data-target="#exampleModal"--}} href="{{route('dashboard')}}"><i class="fa fa-fw fa-sign-out"></i>Sair do Admin</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Navigation-->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            @include('admin.layouts.breadcrumb')

            @yield('content')

        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © {{env('APP_NAME')}} 2021 {{--s | Desenvolvido com <i class="fa fa-heart"></i> por <a href="https://www.linkedin.com/in/alisson-santos-9332b7219/" target="_blank">Alisson Santos</a>--}} </small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#0">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin-assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('admin-assets/js/jquery.datetimepicker.full.js')}}"></script>
    <script src="{{asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin-assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('admin-assets/vendor/chart.js/Chart.js')}}"></script>
    <script src="{{asset('admin-assets/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('admin-assets/vendor/jquery.magnific-popup.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin-assets/js/admin.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>

    @yield('script')
</body>

</html>
