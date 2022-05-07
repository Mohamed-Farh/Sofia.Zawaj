<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;

use Cache;
use Illuminate\Support\Facades\Auth;

class MemberActivity
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
        if( Auth::guard('member')->check() )
        {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-' . Auth::guard('member')->id(), true, $expiresAt);

            /* last seen */
            Member::where('id', Auth::guard('member')->id())->update(['last_seen' => now()]);
        
            
        }elseif( Auth::guard('member_api')->check() )
        {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-' . Auth::guard('member_api')->id(), true, $expiresAt);

            /* last seen */
            Member::where('id', Auth::guard('member_api')->id())->update(['last_seen' => now()]);
        }
        

        return $next($request);
    }
}
