<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name'     => 'Alex Morgan',
                'email'    => 'admin@portfolio.com',
                'password' => Hash::make('Admin@1234'),
            ]
        );
    }
}