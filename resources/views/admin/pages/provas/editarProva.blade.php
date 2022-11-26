@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/editarProva.js')}}?v={{time()}}"></script>
@endsection

@section('content')
<!-- Page Heading -->

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2>
                <i class="fa fa-file"></i>Editando: {{$prova->nomeProva}}
            </h2>
        </div>
        <form class="editarProvaFrm" action="{{route('api.admin.provas.editar')}}" method="POST">
            <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
            <input type="hidden" name="idProva" value="{{$prova->idProva}}">

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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Situação</label>
                        <div class="styled-select">
                            <select name="situacao">
                                <option value="0" @selected(($prova->situacao == 0 ? true : false))>Inativo</option>
                                <option value="1" @selected(($prova->situacao == 1 ? true : false))>Recebendo Apostas</option>
                                <option value="2" @selected(($prova->situacao == 2 ? true : false))>Aguardando Prova</option>
                                <option value="3" @selected(($prova->situacao == 3 ? true : false))>Finalizado</option>
                                <option value="4" @selected(($prova->situacao == 4 ? true : false))>Cancelado</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

        </form>
        <button type="submit" class="btn_1 medium">Atualizar Prova</button>
    </div>

    <form class="novoConjuntoForm" action="{{route('api.admin.provas.conjunto.create')}}" method="POST">
        <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
        <input type="hidden" name="idProva" value="{{$prova->idProva}}">

        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-dollar"></i>Conjuntos de Apostas</h2>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <h6>Conjuntos</h6>
                    <table id="conjuntos-edit-list-container" >
                        <input type="hidden" id="conjunto_URL" value="{{route('api.admin.provas.definirvencedor')}}">
                        <input type="hidden" id="apikey" value="{{auth()->user()->apikey}}">
                        @foreach ($prova->conjuntos as $conjunto)
                        <tr class="conjuntos-edit-list-item">
                            <td>
                                <div class="row">
                                    <div class="col-md-1 mt-2 mr-1">
                                        <div class="form-group">
                                            <input type="text" id="conjuntoOrdem_{{$conjunto->idProvaConjunto}}" conjuntoOrdem="" value="{{$conjunto->ordem}}" class="form-control conjuntoOrdem" placeholder="Nº">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2 mr-2">
                                        <div class="form-group">
                                            <input type="text" id="conjuntoNome_{{$conjunto->idProvaConjunto}}" conjuntoNome="" value="{{$conjunto->nomeConjunto}}" class="form-control conjuntoNome" placeholder="Nome">
                                        </div>
                                    </div>

                                    <div class="col-md-1 mt-2 mr-2">
                                        <button type="button" id="conjunto_{{$conjunto->idProvaConjunto}}" class="btn_1 gray small conjunto-btn" href="#" style="border-radius: 4px">
                                            <i class="fa fa-fw fa-save"></i> Salvar
                                        </button>
                                    </div>

                                    <div class="col-md-2 mt-2 mr-2">
                                        <div class="form-group">
                                            @if ($prova->situacao == 1 || $prova->situacao == 2)
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

                    <a href="#0" class="btn_1 gray add-conjuntos-list-item"><i class="fa fa-fw fa-plus-circle"></i>Adicionar Item</a>

                </div>
            </div>

            <!-- /row-->
        </div>

        <button type="submit" class="btn_1 medium">Adicionar Novos Conjuntos</button>
    </form>

@endsection
