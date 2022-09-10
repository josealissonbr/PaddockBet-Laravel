@extends('admin.layouts.app')

@section('content')


<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-users"></i>
                </div>
                <div class="mr-5">
                    <h5>{{\App\Models\User::where('permission', '!=', 0)->count()}} Usuários Ativos</h5>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.usuarios')}}">
                <span class="float-left">Ver Todos</span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-calendar"></i>
                </div>
                <div class="mr-5">
                    <h5>{{\App\Models\Eventos::where('situacao', '=', 1)->count()}} Eventos Ativos</h5>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.eventos')}}">
                <span class="float-left">Ver Todos</span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-default o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5">
                    <h5>{{\App\Models\Provas::where('situacao', 1)->orWhere('situacao', 2)->count()}} Provas Ativas</h5>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.provas')}}">
                <span class="float-left">Ver Todas</span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-money"></i>
                </div>
                <div class="mr-5">
                    <h5>R$ {{number_format(\App\Models\Apostas::whereDate('created_at', Carbon\Carbon::today())->sum('valorAposta'), 2, ',', ' ')}} Apostados Hoje</h5>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                {{--<span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>--}}
            </a>
        </div>
    </div>
</div>

@endsection
