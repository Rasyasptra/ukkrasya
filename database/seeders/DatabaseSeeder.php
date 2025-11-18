<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists (check both username and email)
        $admin = User::where('username', 'admin')
            ->orWhere('email', 'admin@example.com')
            ->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]);
            $this->command->info("✓ Admin user created (username: admin, password: admin123)");
        } else {
            $this->command->info("✓ Admin user already exists (username: {$admin->username})");
        }

        // Create regular user if not exists (check both username and email)
        $user = User::where('username', 'user')
            ->orWhere('email', 'user@example.com')
            ->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'is_active' => true,
            ]);
            $this->command->info("✓ User created (username: user, password: user123)");
        } else {
            $this->command->info("✓ User already exists (username: {$user->username})");
        }

        // Create test user Rasya if not exists (check both username and email)
        $rasya = User::where('username', 'rasya')
            ->orWhere('email', 'rasya@example.com')
            ->first();
        
        if (!$rasya) {
            $rasya = User::create([
                'name' => 'Rasya',
                'username' => 'rasya',
                'email' => 'rasya@example.com',
                'password' => Hash::make('rasya123'),
                'role' => 'user',
                'is_active' => true,
            ]);
            $this->command->info("✓ User 'rasya' created (username: rasya, password: rasya123)");
        } else {
            $this->command->info("✓ User 'rasya' already exists (username: {$rasya->username})");
        }

        $this->command->info("\n=== SEEDING COMPLETED ===");
    }
}
