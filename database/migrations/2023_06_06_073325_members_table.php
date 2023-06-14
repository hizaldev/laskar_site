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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('unit_id');
            $table->string('no_anggota', 50);
            $table->string('no_pendaftaran', 100)->nullable();
            $table->string('golongan_darah', 10)->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('nama_lengkap', 100);
            $table->string('agama', 100);
            $table->string('tempat_lahir', 100);
            $table->string('no_telpon', 100);
            $table->string('email', 100);
            $table->uuid('size_id');
            $table->string('nipeg', 100);
            $table->string('grade', 20);
            $table->string('sign')->nullable();
            $table->string('ip_address')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->uuid('dpd_id')->nullable();
            $table->uuid('dpc_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('bank_id')->nullable();
            $table->string('no_rekening')->nullable();
            $table->enum('is_dpp', ['YES','NO'])->default('NO');
            $table->date('tgl_anggota')->nullable();
            $table->date('tgl_pendaftaran')->nullable();
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
        Schema::dropIfExists('members');
        
    }
};
