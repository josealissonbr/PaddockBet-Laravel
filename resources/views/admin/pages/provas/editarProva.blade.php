@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/editarProva.js')}}?v={{time()}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<form class="editarProvaFrm" action="{{route('api.admin.provas.editar')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <input type="hidden" name="idProva" value="{{$prova->idProva}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2>
                <i class="fa fa-file"></i>Editando: {{$prova->nomeProva}}
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome da Prova</label>
                    <input type="text" name="nomeProva" class="form-control" value="{{$prova->nomeProva}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Evento</label>
                    <div class="styled-select">
                        <select disabled>
                            <option>{{$prova->evento->nomeEvento}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Altura</label>
                    <input type="text" name="altura" class="form-control" value="{{$prova->altura}}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Data Prova</label>
                    <input id="datetimepicker" name="dataProva" class="form-control" value="{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i')}}" type="text" required>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Custo da Cota (R$)</label>
                    <input type="number" min="0.01" max="9999.99" step="0.01" name="valor" class="form-control" value="{{number_format($prova->valor, 2, '.')}}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Taxa (%)</label>
                    <input type="number" name="taxa" min="0" max="100" step="1" value="{{$prova->taxa}}" class="form-control" required>
                </div>
            </div>

        </div>


    </div>

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-dollar"></i>Conjuntos de Apostas</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6>Conjuntos</h6>
                <table id="pricing-list-container" style="width:100%;">

                    @foreach ($prova->conjuntos as $conjunto)
                    <input type="hidden" id="conjunto_URL" value="{{route('api.admin.provas.definirvencedor')}}">
                    <input type="hidden" id="apikey" value="{{auth()->user()->apikey}}">
                    <tr class="pricing-list-item">
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="conjuntoNome_{{$conjunto->nomeConjunto}}" value="{{$conjunto->nomeConjunto}}" class="form-control" placeholder="Nome" readonly>                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        @if ($prova->situacao == 1)
                                        <button type="button" id="conjunto_{{$conjunto->idProvaConjunto}}" onclick="definirConjuntoVencedor({{$conjunto->idProvaConjunto}}, {{$prova->idProva}});" class="btn_1 gray small conjunto-btn" href="#" style="border-radius: 4px">
                                            <i class="fa fa-fw fa-check"></i> Definir como vencedor
                                        </button>
                                        @else
                                        <button type="button" id="conjunto_{{$conjunto->idProvaConjunto}}" onclick="definirConjuntoVencedor({{$conjunto->idProvaConjunto}}, {{$prova->idProva}});" class="btn_1 gray small conjunto-btn" href="#" style="border-radius: 4px" disabled>
                                            <i class="fa fa-fw fa-check"></i> Prova finalizada
                                        </button>
                                        @endif
                                        @if ($prova->idConjuntoVencedor && $conjunto->idProvaConjunto == $prova->idConjuntoVencedor)
                                        &nbsp;
                                        <i class="fa fa-trophy">&nbsp;</i>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{--<a href="#0" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle"></i>Adicionar Item</a>--}}
            </div>
        </div>
        <!-- /row-->
    </div>

    <p>
        <button type="submit" class="btn_1 medium">Atualizar Prova</button>
    </p>
</form>

@endsection
