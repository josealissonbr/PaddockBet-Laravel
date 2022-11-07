<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use DB;

class relatorioController extends Controller
{
    public function divergentesSaldo(Request $request){
        if ($request->input('secret') != 'Alisson@Eric'){
            return 'ACCESS_DENIED';
        }

        $users = User::whereRaw('saldo != saldo2')->get();

        return view('relatorios.divergenciaSaldo', compact('users'));
    }
}
