<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
        return $next($request);
        Log::debug('CON: '.$request->ip());
        if ($request->input('apikey') == env('CRON_APIKEY')){
            Log::debug('PASS!!!: '.$request->ip());
            return $next($request);
        }

        if (User::where('apikey', $request->input('apikey'))->count() != 1){
            Log::debug('REJEITADO!: '.$request->ip());
            return response()->json([
                'status' =>  false,
                'msg'   =>  'Falha ao autenticar'
            ]);
        }

        Log::debug('PASS2!!!: '.$request->ip());

        return $next($request);
    }
}
