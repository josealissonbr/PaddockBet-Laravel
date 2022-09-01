<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\authenticationLogs;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            $user = User::where('email', $request->input('email'))->get('id')->first();
            authenticationLogs::create([
                'idCliente' => $user->id,
                'ip'        => $request->ip(),
                'agent'     => $request->userAgent(),
            ]);
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withErrors('Ops! Você inseriu credenciais inválidas');
    }

    public function postRegistration(Request $request)
    {
        //return $request->all();
        //return User::where('email', $request->input('email'))->count();
        if (User::where('email', $request->input('emailAdd'))->count() > 0){
            return response()->json([
                'status' => false,
                'msg'    => 'Email já está cadastrado!'
            ]);
        }

        if (User::where('cpf', $request->input('cpfNumber'))->count() > 0){
            return response()->json([
                'status' => false,
                'msg'    => 'CPF já está cadastrado!'
            ]);
        }

        $data = $request->all();
        $check = $this->create($data);

        $credentials = ['email' => $request->input('emailAdd'), 'password' => $request->input('passwordNo')];

        Auth::attempt($credentials);

        /*if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }*/

        return response()->json([
            'status' => true,
            'msg'    => 'Conta criada com sucesso!'
        ]);

        //return redirect(route("dashboard"))->withSuccess('Great! You have Successfully loggedin');
    }

    public function create(array $data)
    {
      return User::create([
        'nome'          => $data['firstName']." ".$data['lastName'],
        'cpf'           => $data['cpfNumber'],
        'email'         => $data['emailAdd'],
        'telefone'      => $data['mobileNumber'],
        'nascimento'    => Carbon::parse($data['dataNascimento']),
        'apikey'        => Str::random(16),
        'password'      => Hash::make($data['passwordNo'])
      ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
