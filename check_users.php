<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "\n=== DAFTAR USER DI DATABASE ===\n\n";
echo "Total Users: " . User::count() . "\n\n";

$users = User::all(['id', 'name', 'username', 'email', 'role']);

foreach ($users as $user) {
    echo sprintf(
        "ID: %-3d | Name: %-20s | Username: %-12s | Email: %-30s | Role: %s\n",
        $user->id,
        $user->name,
        $user->username,
        $user->email,
        $user->role
    );
}

echo "\n=== INFORMASI LOGIN ===\n\n";
echo "User Accounts (role: user):\n";
$regularUsers = User::where('role', 'user')->get(['name', 'username']);
foreach ($regularUsers as $u) {
    echo "  - Username: {$u->username} | Name: {$u->name}\n";
}

echo "\nAdmin Accounts (role: admin):\n";
$adminUsers = User::where('role', 'admin')->get(['name', 'username']);
foreach ($adminUsers as $u) {
    echo "  - Username: {$u->username} | Name: {$u->name}\n";
}

echo "\n================================\n";
