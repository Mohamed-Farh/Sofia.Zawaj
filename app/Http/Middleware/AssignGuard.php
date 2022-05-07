<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class AssignGuard extends BaseMiddleware
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if($guard != null)
    //     {
    //         auth()->shouldUse($guard); //shoud you user guard / table
    //         $token = $request->header('auth-token');
    //         $request->headers->set('auth-token', (string) $token, true);
    //         $request->headers->set('Authorization', 'Bearer '.$token, true);
    //         try {
    //           //  $user = $this->auth->authenticate($request);  //check authenticted user
    //             $user = JWTAuth::parseToken()->authenticate();
    //         } catch (TokenExpiredException $e) {
    //             return  $this -> returnError('401','Unauthenticated user');
    //         } catch (JWTException $e) {

    //             return  $this -> returnError('', 'token_invalid'.$e->getMessage());
    //         }

    //     }
    //      return $next($request);
    // }
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
        {
            auth()->shouldUse($guard); //shoud you user guard / table
            // $token = $request->header('auth-token');
            // $request->headers->set('auth-token', (string) $token, true);
            // $request->headers->set('Authorization', 'Bearer '.$token, true);
            $token =  $request->header('auth-token') != '' ? $request->header('auth-token') : JWTAuth::getToken();
            try {
                $user = JWTAuth::authenticate($token);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return $next($request);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Token Invalid',
                ], 500);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], 500);
            }

        }
         return $next($request);
    }
}
