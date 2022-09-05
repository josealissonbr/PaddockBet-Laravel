@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/novoEvento.js')}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Novo evento</h1>
<form class="novoEventoFrm" action="{{route('api.admin.eventos.novo')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Criar novo evento</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome do Evento</label>
                    <input type="text" name="nomeEvento" class="form-control" placeholder="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="nomeCidade" class="form-control" placeholder="Ex: Maceió" required>
                </div>
            </div>
        </div>
        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Situação</label>
                    <div class="styled-select">
                        <select name="Situacao">
                            <option value="0">Inativo</option>
                            <option value="1" selected>Ativo</option>
                            <option value="2">Cancelado</option>
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
        <button type="submit" class="btn_1 medium">Adicionar Evento</button>
    </p>
</form>
@endsection
