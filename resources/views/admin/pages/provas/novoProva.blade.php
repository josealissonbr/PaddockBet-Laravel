@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/novoProva.js')}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Nova Prova</h1>
<form class="novoProvaFrm" action="{{route('api.admin.provas.novo')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2>
                <i class="fa fa-file"></i>Criar nova prova
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome da Prova</label>
                    <input type="text" name="nomeProva" class="form-control" placeholder="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Situação</label>
                    <div class="styled-select">
                        <select name="Evento" required>
                            <option value="">-- Selecione o Evento --</option>
                            @foreach ($eventos as $evento)
                            <option value="{{$evento->idEvento}}">{{$evento->nomeEvento}}</option>
                            @endforeach
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
                    <input type="text" name="Altura" class="form-control" placeholder="Ex: 1.2m" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Data Prova</label>
                    <input id="datetimepicker" name="dataProva" class="form-control" type="text" required>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Custo da Cota (R$)</label>
                    <input type="number" name="custo" class="form-control" placeholder="Ex: 1.2m" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Taxa (%)</label>
                    <input type="number" name="taxa" min="0" max="100" step="1" class="form-control" required>
                </div>
            </div>

        </div>


    </div>

    <p>
        <button type="submit" class="btn_1 medium">Adicionar Prova</button>
    </p>
</form>
@endsection
