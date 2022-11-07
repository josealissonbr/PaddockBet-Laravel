<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Depositos;

class DepositoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depositos::create([
            'idTransacao'               => 1    ,
            'idCliente'                 => 1    ,
            'valor'                     => 900  ,
            'txid'                      => NULL ,
            'situacao'                  => 1    ,
            'log_approver'              => 'Laravel Seeder',
        ]);
    }
}
