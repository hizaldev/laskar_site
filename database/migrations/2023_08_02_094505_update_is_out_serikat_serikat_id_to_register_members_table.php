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
        Schema::table('register_members', function (Blueprint $table) {
            $table->uuid('union_id')->default('99c9eb79-39fb-40d2-8328-a31eabbb2877')->after('tgl_lahir');
            $table->enum('is_out_serikat', ['Ya', 'Tidak'])->default('Tidak')->after('union_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('register_members', function (Blueprint $table) {
            $table->dropColumn('union_id');
            $table->dropColumn('is_out_serikat');
        });
    }
};
