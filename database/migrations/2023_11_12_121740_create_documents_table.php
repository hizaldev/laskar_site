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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('perihal');
            $table->string('slug');
            $table->uuid('document_properties_id');
            $table->enum('is_public', ['Ya', 'Tidak'])->default('Ya');
            $table->enum('tipe_document', ['file', 'link'])->default('file');
            $table->uuid('jenis_document_id');
            $table->uuid('user_id');
            $table->date('tgl_document');
            $table->string('no_document')->nullable();
            $table->string('location')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('document')->nullable();
            $table->string('links')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
