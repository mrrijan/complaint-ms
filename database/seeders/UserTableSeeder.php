<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Admin User', 'admin@example.com', 'admin', 'password'],
            ['John Doe', 'john@example.com', 'user', 'password'],
        ];

        foreach ($data as [$name, $email, $role, $password]) {

            User::create([
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'password' => Hash::make($password),
            ]);
        }
    }
}
