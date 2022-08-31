<?php $__env->startSection('script'); ?>
    <script defer src="<?php echo e(asset('assets/js/custom/palpites.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Historico de Apostas -->
<div class="payment-history">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="user-panel-title">
                    <h3>20/08/2022 Campeonato Brasileiro - Etapa Maceió</h3>
                    <h3>Faça sua aposta: </h3>
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
                        <div class="different-bet">

                            <div class="single-bet">

                                <div class="left-side">
                                    <span class="bet-place"><?php echo e(Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y h:i')); ?> - <?php echo e($prova->nomeProva); ?></span>
                                    <span class="bet-price"><?php echo e($prova->altura); ?></span>
                                </div>

                            </div>
                           <form id="efetuar-palpite-frm" action="<?php echo e(route('api.provas.fazerPalpite')); ?>" method="POST">
                                <input type="hidden" name="idProva" value="<?php echo e($prova->idProva); ?>">
                                <input type="hidden" name="apikey" value="<?php echo e(auth()->user()->apikey); ?>">
                                <input type="hidden" id="valorProva" value="<?php echo e($prova->valor); ?>">
                                <input type="hidden" id="userSaldo" value="<?php echo e(auth()->user()->saldo); ?>">
                                <div class="row">
                                    <div class="left-side col-md-6">
                                        <span class="bet-place"></span>
                                        <span class="bet-price">
                                            <label> Selecione o conjunto vencedor</label>
                                            <select name="conjuntoSelecionado" class="form-control formulario" required>
                                                <option value="">Selecione</option>
                                                <?php $__currentLoopData = $prova->conjuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($conjunto->idProvaConjunto); ?>"><?php echo e($conjunto->nomeConjunto); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                                
                                            </span>
                                    </div>
                                </div>


                                <br>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn btn-outline-secondary btn-number" disabled="disabled" data-type="minus" data-field="qtdCotas">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="qtdCotas" class="form-control input-number" value="1" min="1" max="99" style="text-align: center;" required>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="qtdCotas">
                                                    <span class="fa fa-plus"></span>
                                                </button>

                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="padding-top: 7px">
                                        <a id="totalPalpiteValor">R$ 20,00</a>
                                    </div>
                                </div>

                                <div class="row" align="center">
                                    <div class="right-side">

                                        <br>
                                        <div class="buttons">
                                            <button type="submit" id="palpite_btn" class="buy-ticket bet-btn bet-btn-dark-light">
                                                <i class="fa fa-save"></i> Fazer Palpite
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>




                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bet-slip-sidebar">

                    <h4 class="title"><?php echo e($prova->evento->nomeEvento); ?> <br> <?php echo e($prova->nomeProva); ?></h4>
                    <h3 class="title" style="text-align:  center"><?php echo e($prova->nomeProva); ?> <?php echo e($prova->altura); ?></h4>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <span class="title">Início</span>
                                <span class="number"><?php echo e(Carbon\Carbon::parse($prova->dataProva)->format('d/m/Y')); ?></span>
                            </li>
                            <li>
                                <span class="title">Valor Por Palpite</span>
                                <span class="number">R$ <?php echo e(number_format($prova->valor, 2, ",", ".")); ?><span>
                            </li>
                        </ul>
                        <div class="total-returns">
                            <span class="text">
                                Prêmio Total desta prova
                            </span>
                            <span class="number">
                                R$ <?php echo e(number_format($prova->saldoAcumulado, 2, ",", ".")); ?>

                            </span>
                             <span class="text">
                               Obs.: O Prêmio aumenta de acordo com o número de palpites
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/miller/envsandbox.millersistemas.com.br/Paddockbet/resources/views/pages/palpite.blade.php ENDPATH**/ ?>