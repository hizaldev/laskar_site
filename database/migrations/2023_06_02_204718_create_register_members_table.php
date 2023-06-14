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
        Schema::create('register_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_pendaftaran', 50)->nullable();
            $table->uuid('unit_id');
            $table->string('golongan_darah', 10)->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
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
            $table->date('tgl_masuk')->nullable();
            $table->string('approval')->nullable();
            $table->string('kode_referral')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_members');
    }
};
