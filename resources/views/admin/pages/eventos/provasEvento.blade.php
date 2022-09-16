@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<script>

    $(document).ready(function() {
        $('#dataTable').DataTable();
      });

    function deleteProva(idProva){
        Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: "Esta ação é irreversível!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Excluir!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.provas.excluir')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idProva: idProva},
                    success: function(data)
                    {
                        if (data.status){
                            $('.provaTr_'+idProva).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Prova excluída com sucesso!'
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
          <h3 class="mr-auto p-3">{{$evento->nomeEvento}} | Provas</h3>
          <div class="btn-group" role="group">
            <a class="btn btn-primary" href="{{route('admin.provas.novo')}}">Adicionar Prova</a>
          </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Prova</th>
                        <th>Evento</th>
                        <th>Altura</th>
                        <th>Saldo Acumulado</th>
                        <th>Valor</th>
                        <th>Taxa</th>
                        <th>Situação</th>
                        <th>Criado em</th>
                        <th>Data Prova</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($evento->provas as $prova)
                    <tr class="provaTr_{{$prova->idProva}}">
                        <td>#{{$prova->idProva}}</td>
                        <td><strong>{{$prova->nomeProva}}</strong></td>
                        <td><strong>{{$prova->evento->nomeEvento}}</strong></td>
                        <td>{{$prova->altura}}</td>
                        <td>R$ {{number_format($prova->saldoAcumulado, 2, ',', ' ')}}</td>
                        <td>R$ {{number_format($prova->valor, 2, ",", " ")}}</td>
                        <td>R$ {{number_format($prova->taxa, 2, ',', ' ')}}</td>
                        <td>
                            @php
                                if ($prova->situacao == 0)
                                    echo '<span class="cancel">Inativo</span>';
                                else if ($prova->situacao == 1)
                                    echo '<span class="approved">Recebendo Apostas</span>';
                                else if ($prova->situacao == 2)
                                    echo '<span class="pending">Aguardando Prova</span>';
                                else if ($prova->situacao == 3)
                                    echo '<span class="cancel">Finalizado</span>';
                                else if ($prova->situacao == 4)
                                    echo '<span class="cancel">Cancelado</span>';
                            @endphp
                        </td>
                        <td>{{Carbon\Carbon::parse($prova->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>{{Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y H:i:s')}}</td>

                        <td>
                            <a href="{{route('admin.provas.editar', $prova->idProva)}}" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteProva({{$prova->idProva}})" class="btn btn-danger btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
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
