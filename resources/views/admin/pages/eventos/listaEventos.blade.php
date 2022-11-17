@extends('admin.layouts.app')

@section('script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
      });

    function deleteEvento(idEvento){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.eventos.excluir')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idEvento: idEvento},
                    success: function(data)
                    {
                        if (data.status){
                            $('.eventoTr_'+idEvento).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Evento excluído com sucesso!'
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg
                            })
                        }
                    },
                    error: function(data)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ocorreu um erro, verifique se todos os campos foram digitados corretamente.'
                        })
                    }
                });

            }
        })
    }

</script>

@endsection

@section('content')


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="d-flex align-items-center">
          <h3 class="mr-auto p-3">Eventos</h3>
          <div class="btn-group" role="group">
            <a class="btn btn-primary" href="{{route('admin.eventos.novo')}}">Adicionar Evento</a>
          </div>
        </div>
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
                    <tr class="eventoTr_{{$evento->idEvento}}">
                        <td>{{$evento->idEvento}}</td>
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
                                else if ($evento->situacao == 3)
                                    echo "Encerrado";
                                @endphp
                        </td>
                        <td>{{Carbon\Carbon::parse($evento->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>
                            <a href="{{route('admin.eventos.provas', $evento->idEvento)}}" class="btn btn-warning btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px; color: #ffff">
                                <i class="fa fa-list"></i>
                            </a>

                            <a href="{{route('admin.eventos.editar', $evento->idEvento)}}" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="deleteEvento({{$evento->idEvento}})" class="btn btn-danger btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
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
