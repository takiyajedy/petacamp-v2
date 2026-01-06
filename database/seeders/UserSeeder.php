<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin PetaCamp',
            'email' => 'admin@petacamp.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Regular Users
        $users = [
            [
                'name' => 'Ahmad Iskandar',
                'email' => 'ahmad@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Muhammad Faiz',
                'email' => 'faiz@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Nurul Ain',
                'email' => 'nurul@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Hafiz Rahman',
                'email' => 'hafiz@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Aminah Hassan',
                'email' => 'aminah@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Rizal Abdullah',
                'email' => 'rizal@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Fatimah Zahra',
                'email' => 'fatimah@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Azlan Osman',
                'email' => 'azlan@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Zarina Ibrahim',
                'email' => 'zarina@example.com',
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Default password: "password"
                'role' => $userData['role'],
            ]);
        }

        $this->command->info('✓ Admin user created: admin@petacamp.test / password123');
        $this->command->info('✓ 10 regular users created with password: password');
    }
}