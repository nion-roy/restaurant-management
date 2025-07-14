<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function findByEmailOrUsername(string $identifier);
} 