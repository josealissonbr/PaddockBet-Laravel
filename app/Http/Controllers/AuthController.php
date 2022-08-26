<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AuthController extends Controller
{
    public function index(){

        if (Auth::Check()){
            return redirect('dashboard');
        }

        return view('pages.auth.login');
    }

    public function cadastro(){

        if (Auth::Check()){
            return redirect('dashboard');
        }

        return view('pages.auth.cadastro');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withErrors('Ops! Você inseriu credenciais inválidas');
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
