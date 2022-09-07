@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/editarEvento.js')}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<form class="editarEventoFrm" action="{{route('api.admin.eventos.editar')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <input type="hidden" name="idEvento" value="{{$evento->idEvento}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Editando: {{$evento->nomeEvento}}</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome do Evento</label>
                    <input type="text" name="nomeEvento" class="form-control" value="{{$evento->nomeEvento}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="cidade" class="form-control" value="{{$evento->cidade}}" required>
                </div>
            </div>
        </div>
        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Situação</label>
                    <div class="styled-select">
                        <select name="situacao">
                            <option value="0" @if ($evento->situacao == 0) @selected(true) @endif>Inativo</option>
                            <option value="1" @if ($evento->situacao == 1) @selected(true) @endif >Ativo</option>
                            <option value="2" @if ($evento->situacao == 2) @selected(true) @endif>Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>

            {{--<div class="col-md-6">
                <div class="form-group">
                    <div action="/file-upload" class="dropzone dz-clickable"><div class="dz-default dz-message"><span>Drop files here to upload</span></div></div>
                </div>
            </div>--}}
        </div>
        <!-- /row-->

    </div>

    <p>
        <button type="submit" class="btn_1 medium">Atualizar Evento</button>
    </p>
</form>
@endsection
