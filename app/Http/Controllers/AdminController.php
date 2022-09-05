<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;

class AdminController extends Controller
{
    public function home(Request $request){
        return view('admin.pages.home');
    }

    public function listaEventos(Request $request){
        $eventos = Eventos::all();
        return view('admin.pages.eventos.listaEventos', compact('eventos'));
    }
}
