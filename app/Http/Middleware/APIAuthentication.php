<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class APIAuthentication
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
        if ($request->input('apikey') == env('CRON_APIKEY')){
            return $next($request);
        }

        if (User::where('apikey', $request->input('apikey'))->count() != 1){
            return response()->json([
                'status' =>  false,
                'msg'   =>  'Falha ao autenticar'
            ]);
        }

        return $next($request);
    }
}
