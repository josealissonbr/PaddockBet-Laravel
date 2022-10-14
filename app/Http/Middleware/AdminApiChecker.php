<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AdminApiChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (User::where('apikey', $request->input('apikey'))->count() != 1){
            return response()->json([
                'status' =>  false,
                'msg'   =>  'Falha ao autenticar'
            ]);
        }

        $user = User::where('apikey', $request->input('apikey'))->get()->first();

        if ($user->permission != 2 && $user->permission != 3){
            return response()->json([
                'status' =>  false,
                'msg'   =>  'Insuficient Permissions'
            ]);
        }


        return $next($request);
    }
}
