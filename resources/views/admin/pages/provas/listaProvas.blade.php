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


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Provas</h1>
<p class="mb-4"></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de provas criadas</h6>
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
                    @foreach($provas as $prova)
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
                                    echo "Inativo";
                                else if ($prova->situacao == 1)
                                    echo "Recebendo Apostas";
                                else if ($prova->situacao == 2)
                                    echo "Aguardando Prova";
                                else if ($prova->situacao == 3)
                                    echo "Finalizado";
                                else if ($prova->situacao == 4)
                                    echo "Cancelado";
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
