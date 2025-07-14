<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmailOrUsername(string $identifier)
    {
        return User::where('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();
    }
} 