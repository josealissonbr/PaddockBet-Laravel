@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/editUsuario.js')}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<form class="novoUsuarioFrm" action="{{route('api.admin.usuarios.edit')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <input type="hidden" name="idUser" value="{{$user->id}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Editando: {{$user->nome}}</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="" value="{{$user->nome}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>CPF (Somente números)</label>
                    <input type="text" name="cpf" class="form-control" value="{{$user->cpf}}"  required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="" value="{{$user->email}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="telefone" class="form-control" value="{{$user->telefone}}" required>
                </div>
            </div>
        </div>

        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nascimento</label>
                    <input type="tel" name="nascimento" class="form-control" id="datepicker" value="{{Carbon\Carbon::parse($user->nascimento)->format('d-m-Y')}}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Senha (Desativado)</label>
                    <input type="password" name="password" class="form-control" value="123456" required disabled>
                </div>
            </div>
        </div>
        <!-- /row-->

        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Permissão</label>
                    <div class="styled-select">
                        <select name="permission" @disabled((auth()->user()->permission == 3))>
                            <option value="-1" @selected(($user->permission == -1))>Banido</option>
                            <option value="1" @selected(($user->permission == 1))>Usuário</option>
                            <option value="2" @selected(($user->permission == 2))>Administrador</option>
                            <option value="2" @selected(($user->permission == 3))>Gerente</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row-->

    </div>

    <p>
        <button type="submit" class="btn_1 medium novoUsuarioFrmSubmit">Salvar</button>
    </p>
</form>
@endsection
