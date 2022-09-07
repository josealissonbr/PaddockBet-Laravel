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
<h1 class="h3 mb-2 text-gray-800">Eventos</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de eventos criados</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Provas</th>
                        <th>Situação</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($eventos as $evento)
                    <tr>
                        <td>#{{$evento->idEvento}}</td>
                        <td><strong>{{$evento->nomeEvento}}</strong></td>
                        <td>{{$evento->cidade}}</td>
                        <td>{{$evento->provas ? $evento->provas->count() : 0}}</td>
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
                        <td>{{Carbon\Carbon::parse($evento->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>
                            <a href="{{route('admin.eventos.editar', $evento->idEvento)}}" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
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
