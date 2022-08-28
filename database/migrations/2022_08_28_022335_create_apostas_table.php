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
        //-apostas (idAposta, idCliente, qtdeCotas[1], valorAposta[20], idProva, datahora, hash, -idProvaConjuntoEscolhido, , premi[0.00], resultado[aguardando, ganhou, perdeu, cancelada] )
        Schema::create('apostas', function (Blueprint $table) {
            $table->id('idAposta');
            $table->integer('idCliente');
            $table->integer('qtdeCotas');
            $table->integer('idProva');
            $table->double('valorAposta');
            $table->string('hash');
            $table->integer('ConjuntoEscolhido');
            $table->double('premio')->default('0.00');
            $table->integer('resultado')->default(0); //0- Aguardando, 1- ganhou, 2- perdeu, 3- cancelado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apostas');
    }
};
