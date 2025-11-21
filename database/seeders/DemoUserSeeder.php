<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo users
        $users = [
            [
                'name' => 'User Demo',
                'username' => 'user',
                'email' => 'user@smkn4bogor.sch.id',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
            [
                'name' => 'Siswa SMK',
                'username' => 'siswa',
                'email' => 'siswa@smkn4bogor.sch.id',
                'password' => Hash::make('siswa123'),
                'role' => 'user',
            ],
            [
                'name' => 'Alumni SMK',
                'username' => 'alumni',
                'email' => 'alumni@smkn4bogor.sch.id',
                'password' => Hash::make('alumni123'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            // Check if user already exists
            $existingUser = User::where('username', $userData['username'])->first();
            
            if (!$existingUser) {
                User::create($userData);
                $this->command->info("Created user: {$userData['username']}");
            } else {
                $this->command->info("User already exists: {$userData['username']}");
            }
        }
    }
}
