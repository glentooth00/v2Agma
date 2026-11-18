<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgmaRegistration extends Model
{
    protected $fillable = [
        'registration_type',
        'classification',
        'membership_id',
        'account_number',
        'district',
        'brgy',
        'street',
        'municipality',
        'date_of_birth',
        'status',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'membership_id', 'membership_id');
    }

}