<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agma_registrations', function (Blueprint $table) {
            $table->id();

            $table->string('registration_type')->default('online_registration');
            $table->string('classification');

            $table->unsignedBigInteger('member_id')->nullable();
            $table->string('account_number')->nullable();

            $table->string('district')->nullable();
            $table->string('brgy')->nullable();
            $table->string('street')->nullable();
            $table->string('municipality')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agma_registrations');
    }
};