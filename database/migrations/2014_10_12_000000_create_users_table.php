<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nipeg', 20)->nullable();
            $table->uuid('induk_id')->nullable();
            $table->uuid('unit_id')->nullable();
            $table->uuid('dpd_id')->nullable();
            $table->uuid('dpc_id')->nullable();
            $table->string('alamat', 500)->nullable();
            $table->enum('is_dpp', ['Yes', 'No'])->default('No');
            $table->enum('status', ['Internal', 'Eksternal'])->default('Internal');
            $table->enum('tipe_akun', ['Normal', 'Google'])->default('Normal');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
