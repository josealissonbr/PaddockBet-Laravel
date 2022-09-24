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
        //eventos (idEvento, data, cidade, situacao[ativo, inativo, cancelado])

        Schema::create('eventos', function (Blueprint $table) {
            $table->id('idEvento'); //id de incremento da transacao (unico)
            $table->string('nomeEvento'); // +Deposito, -Aposta, -Saque
            $table->string('imagem')->nullable(); // +Deposito, -Aposta, -Saque
            $table->string('cidade'); // +Deposito, -Aposta, -Saque
            $table->integer('situacao'); // se refe ao status, seja Pendente, processado, cancelado
            $table->timestamps(); //adiciona os timestamps basicos (created_at/updated_at)
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
        //
    }
};
