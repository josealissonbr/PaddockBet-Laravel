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


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Transações</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tipo de Transação</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Última Atualização</th>
                        <th>Valor</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($transacoes as $transacao)
                    <tr>
                        <td>#{{$transacao->idTransacao}}</td>
                        <td>
                            @php
                                if ($transacao->tipo == 1)
                                    echo "Depósito";
                                else if ($transacao->tipo == 2)
                                    echo "Aposta";
                                else if ($transacao->tipo == 3)
                                    echo "Saque";
                                else if ($transacao->tipo == 4)
                                    echo "Receb. Aposta";
                                else if ($transacao->tipo == 5)
                                    echo "Bônus";
                            @endphp
                        </td>
                        <td>{{$transacao->user->nome}}</td>
                        <td>{{Carbon\Carbon::parse($transacao->created_at)->format('d/m/Y H:i')}}</td>
                        <td>{{Carbon\Carbon::parse($transacao->updated_at)->format('d/m/Y H:i')}}</td>
                        <td style="color: @php if ($transacao->tipo == 2 || $transacao->tipo == 3) {
                            echo "red;";
                        }else echo "green;"; @endphp">@php if ($transacao->tipo == 2 || $transacao->tipo == 3) {
                            echo "-";
                        }else echo "+"; @endphpR$ {{number_format($transacao->valor, 2    , ",", ".")}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
