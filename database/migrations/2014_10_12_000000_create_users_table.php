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
        //(idCliente, cpf, nome, telefone, nascimento, saldo)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf');
            $table->string('email')->unique();
            $table->string('telefone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->datetime('nascimento');
            $table->double('saldo')->default(0.00);
            $table->string('apikey');
            $table->integer('permission')->default(1); // 0- Banido, 1- Usuário, 2- Administrador
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
