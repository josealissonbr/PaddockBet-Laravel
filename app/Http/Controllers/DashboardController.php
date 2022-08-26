<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        if (!Auth::Check()){
            return redirect('login');
        }
        return redirect('dashboard');
    }
    public function dashboard(){
        if (!Auth::Check()){
            return redirect('login');
        }
        return view('pages.dashboard');
    }
}
