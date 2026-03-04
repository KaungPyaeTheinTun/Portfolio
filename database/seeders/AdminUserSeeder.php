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
            ['email' => 'kkpp42877@gmail.com'],
            [
                'name'     => 'KaungPyaeTheinTun',
                'email'    => 'kkpp42877@gmail.com',
                'password' => Hash::make('kkpp12345'),
            ]
        );
    }
}