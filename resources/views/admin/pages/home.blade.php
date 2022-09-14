@extends('admin.layouts.app')

@section('script')

<script>
    // Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: {{json_encode($days)}},
    datasets: [{
      label: "R$ Depositados",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: {{json_encode($DataChart)}},
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: {{min($DataChart)}},
          max: {{max($DataChart)}},
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

</script>

@endsection

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

<h2></h2>
<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-bar-chart"></i>Gráfico de Depósitos | Dia {{min($days)}} até dia {{max($days)}}</h2>
    </div>
    <canvas id="myAreaChart" width="100%" height="30" style="margin:45px 0 15px 0;"></canvas>
</div>

@endsection
