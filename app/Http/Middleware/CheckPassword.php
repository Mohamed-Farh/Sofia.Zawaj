<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( $request->api_password !== env('API_PASSWORD','RDZTr1S7oNulNP2vwxk'))
        {
            return response()->json(['message' => 'Sorry, You Are Unauthenticated User.']);
        }

        return $next($request);
    }
}
