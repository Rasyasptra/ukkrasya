<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists (check both username and email)
        $admin = User::where('username', 'admin')
            ->orWhere('email', 'admin@sekolah.com')
            ->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@sekolah.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]);
            $this->command->info("✓ Admin user created (username: admin, password: admin123)");
        } else {
            $this->command->info("✓ Admin user already exists (username: {$admin->username})");
        }

        // Create regular user for testing if not exists (check both username and email)
        $user = User::where('username', 'user')
            ->orWhere('email', 'user@sekolah.com')
            ->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'User Test',
                'username' => 'user',
                'email' => 'user@sekolah.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'is_active' => true,
            ]);
            $this->command->info("✓ User created (username: user, password: user123)");
        } else {
            $this->command->info("✓ User already exists (username: {$user->username})");
        }
    }
}