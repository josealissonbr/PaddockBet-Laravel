<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //-provas (idProva, idEvento, nomeProva, altura, data, saldoAcumulado(0), situacao[inativo, recebendo apostas, aguardando prova, finalizado, cancelado], valor [R$ 20], taxa)
        Schema::create('provas', function (Blueprint $table) {
            $table->id('idProva');
            $table->integer('idEvento');
            $table->string('nomeProva');
            $table->string('altura');
            $table->double('saldoAcumulado')->default(0);
            $table->double('valor');
            $table->integer('taxa');
            $table->integer('idConjuntoVencedor')->nullable();
            $table->integer('situacao')->default(0); //0- inativo, 1- recebendo apostas, 2- aguardando prova, 3- finalizado, 4- cancelado
            $table->timestamp('dataProva');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provas');
    }
};
