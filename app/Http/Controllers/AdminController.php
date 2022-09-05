<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Provas;

class AdminController extends Controller
{
    public function home(Request $request){
        return view('admin.pages.home');
    }

    public function listaEventos(Request $request){
        $eventos = Eventos::all();
        return view('admin.pages.eventos.listaEventos', compact('eventos'));
    }

    public function listaProvas(Request $request){
        $provas = Provas::all();
        return view('admin.pages.provas.listaProvas', compact('provas'));
    }

}
