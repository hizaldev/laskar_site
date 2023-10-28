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
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('agenda', 255);
            $table->string('slug', 255);
            $table->date('tgl_agenda')->nullable();
            $table->string('tempat', 255)->nullable();
            $table->enum('is_public', ['Ya', 'Tidak'])->default('Ya');
            $table->string('jam_mulai', 20)->nullable();
            $table->string('jam_berakhir', 20)->nullable();
            $table->enum('is_selesai', ['Ya', 'Tidak'])->default('Tidak');
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
        Schema::dropIfExists('attendances');
    }
};
