<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class ScannerUser extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'scanner_users';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'password',
        'assigned_station',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
