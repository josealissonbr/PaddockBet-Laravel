<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eventos;

class EventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eventos::create([
            'nomeEvento'        => "Campeonato Brasileiro",
            'cidade'            => "Maceió",
            'situacao'          => 1,
        ]);
    }
}
