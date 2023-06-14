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
                CREATE VIEW counter_register_view AS
                SELECT 
                    no_pendaftaran,
                    substring_index(no_pendaftaran , '/', 1) AS counter,
                    SUBSTR(no_pendaftaran,6,2) as bulan, SUBSTR(no_pendaftaran,16,4) as thn  
                FROM register_members;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            DROP VIEW IF EXISTS counter_register_view;
        ");
    }

    
};
