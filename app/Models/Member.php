<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    protected $primaryKey = 'id';

    public function agmaRegistrations()
    {
        return $this->hasMany(
            AgmaRegistration::class,
            'membership_id',
            'membership_id'
        );
    }
}
