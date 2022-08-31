<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provas;
use Carbon\Carbon;

class ProvasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provas::create([
            'idEvento'              => 1,
            'nomeProva'             => "Série Especial",
            'altura'                => '1.2m',
            'valor'                 => 20.00,
            'taxa'                  => 30, //porcentagem
            'situacao'              => 1,
            'dataProva'             => Carbon::now()->addDays(2)
        ]);
    }
}
