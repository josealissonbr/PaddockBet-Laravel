@extends('layouts.app')

@section('content')
<!-- standing begin -->
<div class="standing">
    <div class="container">
        {{--<div class="filter-menu">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Last 7 days</option>
                            <option>Last 24 hours</option>
                            <option>Last 12 hours</option>
                            <option>Last 6 hours</option>
                            <option>Last 1 hours</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control">
                            <option>All Sports</option>
                            <option>Football</option>
                            <option>Ice Hocky</option>
                            <option>Badminton</option>
                            <option>Baseball</option>
                            <option>Basketball</option>
                            <option>Tennis</option>
                            <option>Cycling</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Bangla Cricket League</option>
                            <option>Indian Football Federation</option>
                            <option>English premier league</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="standing-list-cover">
            <div class="standing-team-list">
                <h4 class="result-title">Eventos</h4>
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">Evento</th>
                            <th scope="col">Situação</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $key=>$evento)
                        <tr>

                            <td><a href="{{route('dashboard.provas', $evento->idEvento)}}">
                                <span class="single-team">
                                    {{--<span class="logo">
                                        <img src="{{asset('assets/uploads/'.$evento->imagem)}}" alt="">
                                    </span>--}}
                                    <span class="text">
                                        {{$evento->nomeEvento}}

                                        @php
                                            $prova = (\App\Models\Provas::where('idEvento', $evento->idEvento)->orderBy('dataProva', 'asc')->get()->first())
                                        @endphp

                                        <span class="table-sub-label">{{$evento->cidade}}</span>
                                        <span class="table-sub-date">{{ isset($prova->dataProva) ? Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i') : ''}}</span>
                                    </span>
                                </span>
                                </a>
                            </td>
                            <td>
                                @php
                                if ($evento->situacao == 0)
                                    echo "Inativo";
                                else if ($evento->situacao == 1)
                                    echo "Ativo";
                                else if ($evento->situacao == 2)
                                    echo "Cancelado";
                                @endphp
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <span class="text-special">
            <b>Glossary Terms:</b>  <b class="color-sec">W</b> = Wins, <b class="color-sec">T</b> = Ties, <b class="color-sec">Diff</b> = Point differental, <b class="color-sec">L</b> = Loses, <b class="color-sec">PTS</b> = Winning Percentage
        </span>
    </div>
</div>
<!-- standing end -->
@endsection
