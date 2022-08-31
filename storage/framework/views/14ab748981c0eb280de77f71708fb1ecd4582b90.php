<?php $__env->startSection('content'); ?>
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title ">
                    <h3 class="">Apostas</h3>
                    <a href="<?php echo e(route('dashboard.eventos')); ?>" class="vew-more-news bet-btn bet-btn-dark-light offset-sm-6">
                        <i class="fas fa-redo"></i> Nova Aposta
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="transaction-area">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Data Aposta</th>
                                <th scope="col">Codigo Bilhete	</th>
                                <th scope="col">Prova</th>
                                <th scope="col">Data Prova</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Cotas</th>
                                <th scope="col">Resultado</th>
                                <th scope="col">Prêmio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $apostas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aposta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(Carbon\Carbon::parse($aposta->created_at)->format('d/m/Y h:i')); ?></td>
                                 <td><a href="detalheBilhete.php">#<?php echo e($aposta->idAposta); ?></a></td>
                                <th scope="row" class="d-flex">
                                    <a href="<?php echo e(route('dashboard.apostas.detalhes', $aposta->idAposta)); ?>"><?php echo e($aposta->prova->evento->nomeEvento); ?> - <?php echo e($aposta->prova->nomeProva); ?></a></th>
                               <td><?php echo e(Carbon\Carbon::parse($aposta->prova->dataProva)->format('d/m/Y h:i')); ?></td>

                                <td>
                                    <?php
                                        if ($aposta->prova->situacao == 0)
                                            echo "Inativo";
                                        else if ($aposta->prova->situacao == 1)
                                            echo "Recebendo Apostas";
                                        else if ($aposta->prova->situacao == 2)
                                            echo "Aguardando Prova";
                                        else if ($aposta->prova->situacao == 3)
                                            echo "Finalizado";
                                        else if ($aposta->prova->situacao == 4)
                                            echo "Cancelado";
                                    ?>
                                </td>
                                <td><?php echo e($aposta->qtdeCotas); ?></td>
                                <td><?php
                                    if ($aposta->prova->situacao == 3){
                                        if ($aposta->resultado == 1){
                                            echo "<a style='color: green'>Ganhou</a>";
                                        }else{
                                            echo "<a style='color: red'>Perdeu</a>";
                                        }
                                    }else{
                                        echo "N/A";
                                    }
                                ?></td>
                                <td>R$ <?php echo e(number_format($aposta->premio, 2, ',', ' ')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/miller/envsandbox.millersistemas.com.br/Paddockbet/resources/views/pages/apostas.blade.php ENDPATH**/ ?>