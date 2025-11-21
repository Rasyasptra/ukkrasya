<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "=== STRUKTUR TABEL USERS ===\n\n";

// Get columns
$columns = Schema::getColumnListing('users');
echo "Kolom yang ada di tabel users:\n";
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\n=== CEK KOLOM YANG DIBUTUHKAN ===\n";
$requiredColumns = ['name', 'username', 'email', 'password', 'phone', 'address', 'birth_date', 'gender', 'role', 'is_active', 'email_verified_at', 'last_login_at'];

foreach ($requiredColumns as $col) {
    $exists = in_array($col, $columns);
    echo ($exists ? '✅' : '❌') . " $col\n";
}

echo "\n=== SAMPLE DATA ===\n";
$users = DB::table('users')->limit(3)->get();
if ($users->count() > 0) {
    foreach ($users as $user) {
        echo "ID: {$user->id}, Username: {$user->username}, Email: {$user->email}\n";
    }
} else {
    echo "Tidak ada user di database\n";
}
