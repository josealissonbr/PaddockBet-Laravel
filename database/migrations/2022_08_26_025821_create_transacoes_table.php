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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id('idTransacao'); //id de incremento da transacao (unico)
            $table->integer('tipo'); // +Deposito, -Aposta, -Saque
            $table->integer('idCliente'); // id do cliente que esta efetuando a transacao
            $table->double('valor'); //Valor referente ao deposito, aposta ou saque
            $table->integer('situacao'); // se refe ao status, seja Pendente, processado, cancelado
            $table->timestamps(); //adiciona os timestamps basicos (created_at/updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
};
