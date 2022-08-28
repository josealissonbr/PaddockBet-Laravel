<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApostasController extends Controller
{
    //
    public function index(){
        return view('pages.apostas');
    }

    public function palpite(){
        return view('pages.palpite');
    }
}
