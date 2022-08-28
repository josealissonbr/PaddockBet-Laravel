<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'nome'              => "Alisson Santos",
            'cpf'               => "15788943442",
            'email'             => "josealissonbr2003@outlook.com",
            'telefone'          => "8292047888",
            'nascimento'        => Carbon::createFromFormat('d/m/Y', '03/12/2003')->format('Y-m-d'),
            'saldo'             => 900.00,
            'apikey'            => Str::random(16),
            'password'          => Hash::make("123")
        ]);
    }
}
