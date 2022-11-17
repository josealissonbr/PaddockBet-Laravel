@extends('admin.layouts.app')

@section('script')
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>

    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function cancelarSaque(idSaque){
        Swal.fire({
            title: 'Tem certeza que deseja cancelar este saque?',
            text: "O saldo será devolvido ao usuário!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.saques.cancelar')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idSaque: idSaque},
                    success: function(data)
                    {
                        if (data.status){
                            $('.saqueTr_'+idSaque).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Saque cancelado com sucesso!'
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

    function aprovarSaque(idSaque){
        Swal.fire({
            title: 'Tem certeza que deseja cancelar este saque?',
            text: "O saldo será devolvido ao usuário!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: '{{route('api.admin.saques.aprovar')}}',
                    data: {apikey: '{{auth()->user()->apikey}}',idSaque: idSaque},
                    success: function(data)
                    {
                        if (data.status){
                            $('.saqueTr_'+idSaque).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Saque processado com sucesso!'
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
        <h6 class="m-0">Saques pendentes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tipo de Transação</th>
                        <th>Cliente</th>
                        <th>Chave Pix (CPF)</th>
                        <th>Data</th>
                        <th>Última Atualização</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($saques as $saque)
                    <tr class="saqueTr_{{$saque->id}}">
                        <td>{{$saque->id}}</td>
                        <td>
                            @php
                                if ($saque->situacao == 0)
                                    echo "Pendente";
                                else if ($saque->situacao == 1)
                                    echo "Processado";
                                else if ($saque->situacao == 2)
                                    echo "Cancelado";
                                else if ($saque->situacao == 3)
                                    echo "Falha";
                                else
                                    echo "Desconhecido";
                            @endphp
                        </td>
                        <td>{{$saque->user->nome}}</td>
                        <td>{{$saque->user->cpf}}</td>
                        <td>{{Carbon\Carbon::parse($saque->created_at)->format('d/m/Y H:i')}}</td>
                        <td>{{Carbon\Carbon::parse($saque->updated_at)->format('d/m/Y H:i')}}</td>
                        <td>R$ {{number_format($saque->valor, 2    , ",", ".")}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="aprovarSaque({{$saque->id}})" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="cancelarSaque({{$saque->id}})" class="btn btn-danger btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
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
