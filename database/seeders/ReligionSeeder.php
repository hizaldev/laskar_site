<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Religion::create(['id' => '98f329c9-ecaf-49b9-a341-37852dcf3c65','agama' =>'Islam','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Religion::create(['id' => '995a8463-d234-461a-98a5-80b0377fb25c','agama' =>'Kristen','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Religion::create(['id' => '995a846d-4ace-4032-9f42-e473bbb594ac','agama' =>'Hindu','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Religion::create(['id' => '995a8476-08e6-4406-8779-c5ff651c86ef','agama' =>'Budha','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Religion::create(['id' => '995a8480-26ec-4f4b-b810-f2553e77f50e','agama' =>'Katholik','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Religion::create(['id' => '995f8f3a-27b2-4ef9-98e7-98cbe9fcd2ac','agama' =>'-','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
