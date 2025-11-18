<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        Petugas::create([
            'username' => 'user',
            'password' => Hash::make('123456'),
        ]);
    }
}
