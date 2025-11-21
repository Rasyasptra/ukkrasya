<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if users already exist
        $existingUsers = User::whereIn('username', ['user', 'rasya', 'siswa'])->pluck('username')->toArray();
        
        // Create regular user if not exists
        if (!in_array('user', $existingUsers)) {
            User::create([
                'name' => 'User Demo',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]);
            echo "✓ User 'user' berhasil dibuat (username: user, password: user123)\n";
        } else {
            echo "✓ User 'user' sudah ada\n";
        }

        // Create test user Rasya if not exists
        if (!in_array('rasya', $existingUsers)) {
            User::create([
                'name' => 'Rasya',
                'username' => 'rasya',
                'email' => 'rasya@example.com',
                'password' => Hash::make('rasya123'),
                'role' => 'user',
            ]);
            echo "✓ User 'rasya' berhasil dibuat (username: rasya, password: rasya123)\n";
        } else {
            echo "✓ User 'rasya' sudah ada\n";
        }

        // Create student user if not exists
        if (!in_array('siswa', $existingUsers)) {
            User::create([
                'name' => 'Siswa SMK N 4',
                'username' => 'siswa',
                'email' => 'siswa@smkn4bogor.sch.id',
                'password' => Hash::make('siswa123'),
                'role' => 'user',
            ]);
            echo "✓ User 'siswa' berhasil dibuat (username: siswa, password: siswa123)\n";
        } else {
            echo "✓ User 'siswa' sudah ada\n";
        }

        echo "\n=== INFORMASI AKUN USER ===\n";
        echo "1. Username: user     | Password: user123\n";
        echo "2. Username: rasya    | Password: rasya123\n";
        echo "3. Username: siswa    | Password: siswa123\n";
        echo "===========================\n";
    }
}
