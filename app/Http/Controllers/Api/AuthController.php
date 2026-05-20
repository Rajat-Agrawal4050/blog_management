<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegister()
    {

        return view('register');
    }
    public function showLogin()
    {

        return view('login');
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);

        // $token = auth()->login($user);

        // setcookie('jwt_token', $token, time() + 3600, '/');

        // return $this->tokenResponse($token, 201);
        return response()->json([
            'status' => true,
            'user'         => $user,
            'message' => 'Registered Successfully.'
        ], 201);
    }

    /**
     * Login and return JWT.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = auth()->attempt($request->validated());

        if (!$token) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }
        // cookie me token store for 1 hour, response header me - Set-Cookie: jwt_token=eyJ0eXAiOiJKV1Qi... browser autoomatically save karega
        // next request me browser cookie bhejta hai, Cookie: jwt_token=eyJ0eXAiOiJKV1Qi... Developer ko manually bhejne ki zarurat nahi hoti.
        setcookie('jwt_token', $token, time() + 3600, '/');

        return $this->tokenResponse($token);
    }

    /**
     * Get authenticated user profile.
     */

    public function showProfile()
    {
        $data = Auth::user();

        return view('profile', compact('data'));
    }
    /**
     * Refresh the JWT token.
     */
    public function refresh(Request $request)
    {
        // $token = Auth::refresh();

        try {
            $token = $request->cookie('jwt_token');
            if ($token) {
                $newToken = JWTAuth::setToken($token)->refresh();
                setcookie('jwt_token', $newToken, time() + 3600, '/');
                return redirect('/auth/profile')->with('success', 'Token Refreshed Successfully.');
            } else {
                return redirect('/auth/login');
            }
        } catch (\Exception $e) {
            // silent
            return redirect('/auth/login');
        }
    }

    /**
     * Logout (invalidate the token).
     */
    public function logout(Request $request)
    {
        try {
            $token = $request->cookie('jwt_token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch (\Exception $e) {
            // silent
        }

        return redirect()->route('/')
            ->withCookie(cookie()->forget('jwt_token'));
    }

    // ─── Helpers ──────────────────────────────────────────
    private function tokenResponse(string $token, int $status = 200): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
            'user'         => Auth::user(),
        ], $status);
    }
}
