@extends('layouts.app')


@section('script')
<script src="{{asset('assets/js/custom/editarPerfil.js')}}"></script>
@endsection

@section('content')
<div class="about" style="padding: 0px 0;">
    <div class="container">
        <div class="row no-gutters justify-content-center align-items-center">
            <div class="col-xl-8 col-lg-8">
                <form class="editar-perfil-form" action="{{route('api.perfil.atualizarPerfil')}}">
                    <input type="hidden" name="apikey" value="{{auth()->user()->apikey}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">CPF</label>
                        <input class="form-control" type="text" name="cpfNumber" placeholder="{{auth()->user()->cpf}}" readonly>
                        <small id="emailHelp" class="form-text text-muted">Você não pode alterar o seu CPF.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" type="text" name="emailAddress" placeholder="{{auth()->user()->email}}" readonly>
                        <small id="emailHelp" class="form-text text-muted">Contate o suporte se quiser alterar o seu Email.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha (Deixe em branco para manter a atual)</label>
                        <input type="password" class="form-control" name="passwordNo" id="exampleInputPassword1" placeholder="">
                    </div>

                    <button type="submit" class="bet-btn" id="editar-perfil-submit" style="background: #41a92e; border: none; border-radius: 6px;"><i class="fa fa-save"></i> Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
