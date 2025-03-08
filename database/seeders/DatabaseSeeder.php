<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::create([
            'name' => 'Admin Name',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'phone_number' => '081234567890',
            'idadmin' => 'ADMIN001',
            'role' => 'admin',
        ]);

        
    }
}

