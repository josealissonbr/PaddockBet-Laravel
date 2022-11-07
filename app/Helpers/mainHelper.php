<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Depositos;
use App\Models\Transacoes;
use App\Models\Saques;

class mainHelper
{
    public static function recalcSaldo($idUser){

        $user = User::find($idUser);

        $saldoUsuario = 0.00;

        $depositos = Depositos::where('situacao', 1)->where('idCliente', $user->id)->sum('valor');

        $apostas = Transacoes::where('idCliente', $user->id)->where('tipo', 2)->sum('valor');

        $saques = Saques::where('idCliente', $user->id)->whereIn('situacao', [0,1])->sum('valor');

        $recebApostas = Transacoes::where('idCliente', $user->id)->where('tipo', 4)->sum('valor');

        $saldoUsuario = $depositos - $apostas - $saques + $recebApostas;

        $user->saldo2 = $saldoUsuario;

        $user->save();
    }
}
