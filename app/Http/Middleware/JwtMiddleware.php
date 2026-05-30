<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
       
       $token = $request->cookie('jwt_token');
    //    echo('jwt middleware');
       // dd($token);
        if (!$token) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            
            return redirect('/auth/login');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate(); // check user token is authenticated

            if (!$user) {
                return $this->unauthenticated($request);
            }

            Auth::setUser($user); // current request ke liye authenticated user set kiya



        } catch (TokenExpiredException $e) {
            return $this->unauthenticated($request, 'Session expired. Please login again.');
        } catch (TokenInvalidException $e) {
            return $this->unauthenticated($request, 'Invalid session token.');
        } catch (JWTException $e) {
            return $this->unauthenticated($request, 'Authentication error.');
        }

        return $next($request);
    }

    private function unauthenticated(Request $request, string $message = 'Unauthenticated.')
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 401);
        }
        return redirect('/auth/login')
            ->withCookie(cookie()->forget('jwt_token'));
    }
}
