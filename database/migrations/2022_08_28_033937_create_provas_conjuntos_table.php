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
        //-provasConjutos (idProvaConjunto, idProva, nomeConjunto, Situacao)
        Schema::create('provas_conjuntos', function (Blueprint $table) {
            $table->id('idProvaConjunto');
            $table->integer('idProva');
            $table->string('nomeConjunto');
            $table->integer('situacao')->default(1); //0- inativo, 1- ativo
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
        Schema::dropIfExists('provas_conjutos');
    }
};
