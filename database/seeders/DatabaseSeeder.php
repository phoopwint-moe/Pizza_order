<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'superadmin',
            'email' => 'admin@gmail.com',
            'phone' => '0912345678',
            'role' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin1234')
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '098765432',
            'role' => 'user',
            'gender' => 'female',
            'password' => Hash::make('user1234')
        ]);
    }
}
