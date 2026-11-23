<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScannerUser extends Model
{
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
