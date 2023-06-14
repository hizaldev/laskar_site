<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        DB::statement("
                CREATE VIEW counter_member_view AS
                SELECT SUBSTR(no_pendaftaran,9,5) as counter, no_pendaftaran  
                FROM members;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            DROP VIEW IF EXISTS counter_member_view;
        ");
    }
};
