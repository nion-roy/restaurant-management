<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'status' => 1,
                'expire_at' => now()->addYear(),
                'password' => Hash::make('admin@example.com'),
                'profile' => [
                    'bio' => 'Alice is a manager.',
                    'avatar' => null,
                    'address' => '123 Main St',
                ],
            ],
            [
                'name' => 'Bob Jones',
                'username' => 'bob',
                'email' => 'bob@example.com', 
                'status' => 0,
                'expire_at' => now()->addMonths(6),
                'password' => Hash::make('password'),
                'profile' => [
                    'bio' => 'Bob is a chef.',
                    'avatar' => null,
                    'address' => '456 Side St',
                ],
            ],
        ];

        foreach ($users as $userData) {
            $profileData = $userData['profile'];
            unset($userData['profile']);
            $user = User::create($userData);
            $user->profile()->create($profileData);
        }
    }
} 