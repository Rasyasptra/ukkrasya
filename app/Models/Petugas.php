<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas'; // pakai tabel petugas

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
