@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/novoUsuario.js')}}"></script>
@endsection

@section('content')
<!-- Page Heading -->
<form class="novoUsuarioFrm" action="{{route('api.admin.usuarios.novo')}}" method="POST">
    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Criar novo Usuário</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="" value="teste@gmail.com" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>CPF (Somente números)</label>
                    <input type="text" name="cpf" class="form-control" value="15788943442"  required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="" value="gamepleyjk@gmail.com" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="telefone" class="form-control" value="82982047888" required>
                </div>
            </div>
        </div>

        <!-- /row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nascimento</label>
                    <input type="tel" name="nascimento" class="form-control" id="datetimepicker" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" class="form-control" value="123456" required>
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
                        <select name="permission">
                            <option value="-1">Banido</option>
                            <option value="1" selected>Usuário</option>
                            <option value="2">Administrador</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row-->

    </div>

    <p>
        <button type="submit" class="btn_1 medium novoUsuarioFrmSubmit">Adicionar Usuário</button>
    </p>
</form>
@endsection
