<?php $__env->startSection('content'); ?>
<!-- standing begin -->
<div class="standing">
    <div class="container">
        
        <div class="standing-list-cover">
            <div class="standing-team-list">
                <h4 class="result-title">Eventos</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pos</th>
                            <th scope="col">Evento</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Criado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><a href="<?php echo e(route('dashboard.provas', $evento->idEvento)); ?>">
                                <span class="single-team">
                                    <span class="logo">
                                        <img src="<?php echo e(asset('assets/uploads/'.$evento->imagem)); ?>" alt="">
                                    </span>
                                    <span class="text">
                                        <?php echo e($evento->nomeEvento); ?>

                                    </span>
                                </span>
                                </a>
                            </td>
                            <td><?php echo e($evento->cidade); ?></td>
                            <td>
                                <?php
                                if ($evento->situacao == 0)
                                    echo "Inativo";
                                else if ($evento->situacao == 1)
                                    echo "Ativo";
                                else if ($evento->situacao == 2)
                                    echo "Cancelado";
                                ?>
                            </td>
                            <td>
                                <?php echo e(Carbon\Carbon::parse($evento->created_at)->format('d/m/Y')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
        <span class="text-special">
            <b>Glossary Terms:</b>  <b class="color-sec">W</b> = Wins, <b class="color-sec">T</b> = Ties, <b class="color-sec">Diff</b> = Point differental, <b class="color-sec">L</b> = Loses, <b class="color-sec">PTS</b> = Winning Percentage
        </span>
    </div>
</div>
<!-- standing end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/miller/envsandbox.millersistemas.com.br/Paddockbet/resources/views/pages/eventos.blade.php ENDPATH**/ ?>