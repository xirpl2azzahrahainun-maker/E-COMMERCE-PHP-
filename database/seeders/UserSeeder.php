<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('0'),
            'role' => 'Admin',
        ]);
          User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('1'),
            'role' => 'customer',
        ]);
    }
}
