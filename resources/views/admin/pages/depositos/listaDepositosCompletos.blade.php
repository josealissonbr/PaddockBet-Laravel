@extends('admin.layouts.app')

@section('script')
<script src="{{asset('admin-assets/vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<script>

    $(document).ready(function() {
        $('#dataTable').DataTable({
            order: [[0, 'desc']],
        });
    });

</script>

@endsection

@section('content')


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0">Depósitos completos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Status</th>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Data</th>
                        <th>Última Atualização</th>
                        <th>Valor</th>
                        <th>Aprovador</th>
                        {{--<th>Ações</th>--}}
                    </tr>
                </thead>

                <tbody>
                    @foreach($depositos as $deposito)
                    <tr class="saqueTr_{{$deposito->id}}">
                        <td>{{$deposito->id}}</td>
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
                        <td>{{$deposito->log_approver}}</td>
                        {{--<td>
                            <a href="javascript:void(0)" onclick="" class="btn btn-info btn-circle btn-sm" style="margin-left: 5px; margin-right: 5px">
                                <i class="fa fa-check"></i>
                            </a>

                        </td>--}}

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
