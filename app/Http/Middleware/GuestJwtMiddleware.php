<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Cookie;

class GuestJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = trim($request->cookie('jwt_token'));
        //  dd($token);
        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate(); // checks and sets current auth user 
            } catch (TokenExpiredException $e) {
              //  dd($e->getMessage());
            } catch (TokenInvalidException $e) {
               //  dd($e->getMessage());
            } catch (JWTException $e) {
              //  dd($e->getMessage());
            } catch (\Exception $e) {
              //   dd($e->getMessage());
                // invalid/expired token, allow through
            }
        }
          
         return $next($request);
    }
}
