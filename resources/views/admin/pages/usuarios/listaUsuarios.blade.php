@extends('admin.layouts.app')

@section('script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>

    $(document).ready(function() {
        $('#dataTable').DataTable();
      });
</script>

@endsection

@section('content')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Usuários</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuários</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Permissões</th>
                        <th>Saldo</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>#{{$user->id}}</td>
                        <td><strong>{{$user->nome}}</strong></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->telefone}}</td>
                        <td>
                            @php
                                if ($user->permission == 0)
                                    echo "Banido";
                                else if ($user->permission == 1)
                                    echo "Usuário";
                                else if ($user->permission == 2)
                                    echo "Administrador";
                                @endphp
                        </td>
                        <td>R$ {{number_format($user->saldo, 2, ',', ' ')}}</td>
                        <td>{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>
                            <a href="{{route('admin.usuarios.edit', $user->id)}}" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
