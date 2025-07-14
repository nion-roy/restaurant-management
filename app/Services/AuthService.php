<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($request)
    {
        DB::beginTransaction();
        try {
            if (!$request->has('username') && !$request->has('email')) {
                DB::rollBack();
                return [false, 'The username or email field is required.'];
            }

            $identifier = $request->input('username') ?? $request->input('email');
            $password = $request->input('password');
            
            $user = $this->userRepository->findByEmailOrUsername($identifier);
            if (!$user || !Hash::check($password, $user->password)) {
                DB::rollBack();
                return [false, 'Invalid username/email or password'];
            }
            if (!$user->status || $user->status != 1) {
                DB::rollBack();
                return [false, 'User is inactive'];
            }

            // Handle remember me
            $customClaims = [];
            if ($request->has('remember_me') && $request->boolean('remember_me')) {
                $customClaims['exp'] = now()->addDays(30)->timestamp;
                $tokenValue = Str::random(60);
                $user->forceFill(['remember_token' => $tokenValue]);
                $user->save();
                Log::info('Remember token set for user', ['user_id' => $user->id, 'remember_token' => $tokenValue]);
            }
            
            $token = JWTAuth::fromUser($user, $customClaims);
            DB::commit();
            return [true, $token, [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]];
        } catch (JWTException $e) {
            DB::rollBack();
            return [false, 'Could not create token'];
        } catch (\Exception $e) {
            DB::rollBack();
            return [false, $e->getMessage()];
        }
    }
} 