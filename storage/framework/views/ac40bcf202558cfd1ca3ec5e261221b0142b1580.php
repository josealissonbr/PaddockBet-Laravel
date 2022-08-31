<?php $__env->startSection('content'); ?>
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3><?php echo e($evento->nomeEvento); ?></h3>
                </div>
            </div>
        </div>

    </div>
</div>
    <!-- payment history end -->
 <!-- bet-slip begin -->
<div class="bet-slip" style="padding: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="bet-slip-content">
                    <div class="box-heading">
                        <h4>Provas</h4>
                        <h4></h4>
                    </div>
                    <div>
                        <?php $__currentLoopData = $provas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prova): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="different-bet">
                            <div class="single-bet">
                                <div class="left-side">
                                    <span class="bet-place"><?php echo e(Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y h:i')); ?>  - <?php echo e($prova->nomeProva); ?></span>
                                    <span class="bet-price"><?php echo e($prova->altura); ?></span>
                                </div>
                                <div class="right-side">
                                    <div class="buttons">
                                        <a href="<?php echo e(route('dashboard.provas.palpite', $prova->idProva)); ?>" class="buy-ticket bet-btn bet-btn-dark-light"><i class="fa fa-plus"></i> Fazer Palpite</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bet-slip-sidebar">
                    <h4 class="title">Campeonato Brasileiro - Etapa Maceió</h4>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <span class="title">Início</span>
                                <span class="number">20/06/2022</span>
                            </li>
                            <li>
                                <span class="title">Valor Por Palpite</span>
                                <span class="number">R$ 20,00<span>
                            </li>
                        </ul>
                        <div class="total-returns">
                            <span class="text">
                                Prêmio Total
                            </span>
                            <span class="number">
                                R$ 19.500
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bet-slip end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/miller/envsandbox.millersistemas.com.br/Paddockbet/resources/views/pages/provas.blade.php ENDPATH**/ ?>