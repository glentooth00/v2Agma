<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agma_attendances', function (Blueprint $table) {
            $table->id();

            // Link attendance to the member's AGMA registration.
            $table->foreignId('agma_registration_id')
                ->unique()
                ->constrained('agma_registrations')
                ->cascadeOnDelete();

            // Actual date and time the member checked in.
            $table->timestamp('attended_at')->useCurrent();

            // User or staff account that confirmed attendance.
            $table->foreignId('checked_in_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional identifier of the device used for scanning.
            $table->string('device_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agma_attendances');
    }
};
