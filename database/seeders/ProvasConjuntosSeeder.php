<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\provasConjuntos;

class ProvasConjuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        provasConjuntos::create([
            'idProva'           =>  1,
            'nomeConjunto'      =>  'Fulano/Cavalo 1',
        ]);

        provasConjuntos::create([
            'idProva'           =>  1,
            'nomeConjunto'      =>  'Cicrano/Cavalo 2',
        ]);
    }
}
