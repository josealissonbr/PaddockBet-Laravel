@extends('admin.layouts.app')

@section('script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>

    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function cancelarSaque(idDeposito){
        Swal.fire({
            title: 'Tem certeza que deseja cancelar este depósito?',
            text: "Esta ação é irreversível!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.depositos.cancelar')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idDeposito: idDeposito},
                    success: function(data)
                    {
                        if (data.status){
                            $('.saqueTr_'+idDeposito).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Depósito cancelado com sucesso!'
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
                            text: 'Ocorreu um erro'
                        })
                    }
                });

            }
        })
    }

    function aprovarSaque(idDeposito){
        Swal.fire({
            title: 'Tem certeza que deseja aprovar este deposito?',
            text: "O saldo será adicionado ao usuário!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.depositos.aprovar')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idDeposito: idDeposito},
                    success: function(data)
                    {
                        if (data.status){
                            $('.saqueTr_'+idDeposito).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Depósito processado com sucesso!'
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
                            text: 'Ocorreu um erro.'
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
    <div class="card-header py-3">
        <h6 class="m-0">Depósitos pendentes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tipo de Transação</th>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Data</th>
                        <th>Última Atualização</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($depositos as $deposito)
                    <tr class="saqueTr_{{$deposito->id}}">
                        <td>#{{$deposito->id}}</td>
                        <td>
                            @php
                                if ($deposito->situacao == 0)
                                    echo "Pendente";
                                else if ($deposito->situacao == 1)
                                    echo "Pago";
                                else if ($deposito->situacao == 2)
                                    echo "Cancelado";
                                else if ($deposito->situacao == 3)
                                    echo "Falha";
                                else
                                    echo "Desconhecido ";
                            @endphp
                        </td>
                        <td>{{$deposito->user->nome}}</td>
                        <td>{{$deposito->user->cpf}}</td>
                        <td>{{Carbon\Carbon::parse($deposito->created_at)->format('d/m/Y H:i')}}</td>
                        <td>{{Carbon\Carbon::parse($deposito->updated_at)->format('d/m/Y H:i')}}</td>
                        <td>R$ {{number_format($deposito->valor, 2    , ",", ".")}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="aprovarSaque({{$deposito->id}})" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="cancelarSaque({{$deposito->id}})" class="btn btn-danger btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-ban"></i>
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
