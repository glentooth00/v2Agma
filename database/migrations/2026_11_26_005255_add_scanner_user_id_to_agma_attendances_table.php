
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agma_attendances', function (Blueprint $table) {
            $table->foreignId('scanner_user_id')
                ->nullable()
                ->after('checked_in_by')
                ->constrained('scanner_users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('agma_attendances', function (Blueprint $table) {
            $table->dropConstrainedForeignId('scanner_user_id');
        });
    }
};
