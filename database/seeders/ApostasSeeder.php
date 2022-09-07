<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apostas;
use Carbon\Carbon;
class ApostasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$now = Carbon::now();
        Apostas::create([
            'idCliente'                         => 1,
            'qtdeCotas'                         => 5,
            'idProva'                           => 1,
            'valorAposta'                       => 100.00,
            'hash'                              => md5('alisson@eric:'.$now),
            'ConjuntoEscolhido'                 => 1,
            'resultado'                         => 0, //0- Aguardando, 1- ganhou, 2- perdeu, 3- cancelado
            'created_at'                        => $now,
        ]);*/
    }
}
