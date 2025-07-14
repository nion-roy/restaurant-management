<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Traits\ResponseMessage;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ResponseMessage;

    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService(new UserRepository());
    }

    /**
     * Handle a login request to the application and return a JWT token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        [$success, $result, $user] = $this->authService->login($request) + [null, null, null];

        if ($success) {
            return $this->success($user + ['token' => $result], 'Login successful');
        } else {
            return $this->error($result, 401);
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }
} 