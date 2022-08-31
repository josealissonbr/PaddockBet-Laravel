<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transacoes;

class TransacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transacoes::create([
            'tipo'                      => 1, //1- Deposito, 2- Aposta, 3- Saque
            'idCliente'                 => 1,
            'valor'                     => 900,
            'situacao'                  => 1,
        ]);
    }
}
