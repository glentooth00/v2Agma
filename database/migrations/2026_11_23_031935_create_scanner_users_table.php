
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanner_users', function (Blueprint $table) {
            $table->id();

            // Scanner user information
            $table->string('firstname', 100);
            $table->string('middlename', 100)->nullable();
            $table->string('lastname', 100);

            // Scanner login credentials
            $table->string('username', 50)->unique();
            $table->string('password');

            // Assigned scanner station (e.g. STATION-01)
            $table->string('assigned_station', 50);

            // Account status
            $table->enum('status', ['active', 'disabled'])
                ->default('active');

            $table->timestamps();

            // Useful for station-based filtering
            $table->index('assigned_station');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanner_users');
    }
};
