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
use App\Http\Requests;
use App\Mail\RedefinirSenha;
use Illuminate\Support\Facades\Mail;

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

    public function redefinirSenha(){

        return view('pages.auth.resetpassword');
    }

    public function postRedefinirSenha(Request $request){

        $request->validate([
            'email' => 'required',
        ]);

        $email = $request->input('email');

        if (User::where('email', $email)->count() < 1){
            return redirect()->back()->withErrors(['msg' => 'Nenhum usuário encontrado com este email']);

        }

        $token = Str::random(32);

        \App\Models\PasswordResets::insert([
            'email' => $email,
            'token' => $token
        ]);

        Mail::to($email)->send(new RedefinirSenha($token));


        session()->put('success', 'Um email foi enviado para você contendo um link para redefinir sua senha!');

        return redirect()->back();

    }

    public function RedefinirSenhaToken($token, Request $request){

        return view('pages.auth.resetpassword_token', compact('token'));
    }

    public function postRedefinirSenhaToken(Request $request){

        $request->validate([
            'password' => 'required',
            'passToken' => 'required',
        ]);

        $password = $request->input('password');
        $passToken = $request->input('passToken');

        $pr = \App\Models\PasswordResets::where('token', $passToken)->get()->first();

        // $pr->email;

        $user = \App\Models\User::where('email', $pr->email)->update([
            'password' => Hash::make($password),
        ]);

        session()->put('success', 'Sua senha foi alterada!');

        return redirect()->back();
    }
}
