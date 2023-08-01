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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->longText('kategori_berita_id');
            $table->longText('berita');
            $table->string('slug')->unique();
            $table->string('penulis')->nullable();
            $table->enum('is_show', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('is_schedule', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('is_public', ['Ya', 'Tidak'])->default('Tidak');
            $table->date('tgl_tayang_mulai')->nullable();
            $table->date('tgl_tayang_berakhir')->default('9999-12-30');
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
        Schema::dropIfExists('news');
    }
};
