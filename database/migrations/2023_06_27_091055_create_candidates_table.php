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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vote_id');
            $table->string('nama_lengkap', 255);
            $table->uuid('dpd_id')->nullable();
            $table->string('dpd', 255)->nullable();
            $table->uuid('dpc_id')->nullable();
            $table->string('dpc', 255)->nullable();
            $table->mediumText('visi')->nullable();
            $table->mediumText('misi')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
