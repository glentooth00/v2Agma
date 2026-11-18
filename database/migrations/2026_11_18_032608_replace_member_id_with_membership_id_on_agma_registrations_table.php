<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agma_registrations', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');

            $table->string('membership_id')->nullable()->after('classification');
        });
    }

    public function down(): void
    {
        Schema::table('agma_registrations', function (Blueprint $table) {
            $table->dropColumn('membership_id');

            $table->unsignedBigInteger('member_id')->nullable()->after('classification');

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->nullOnDelete();
        });
    }
};