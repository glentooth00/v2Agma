<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgmaAttendance extends Model
{
    protected $table = 'agma_attendances';

    protected $fillable = [
        'agma_registration_id',
        'attended_at',
        'attendance_type',
        'checked_in_by',
        'scanner_user_id',
        'device_id',
    ];

    protected function casts(): array
    {
        return [
            'attended_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(
            AgmaRegistration::class,
            'agma_registration_id'
        );
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(
            ScannerUser::class,
            'scanner_user_id'
        );
    }
}
