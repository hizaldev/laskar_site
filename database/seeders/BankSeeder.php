<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create(['id' => '994d745a-60a9-4307-a7ea-6f1bb85d046f','bank' =>'MANDIRI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a8510-594e-4cb2-80ce-6c9718a3bc39','bank' =>'BCA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a851c-35ee-472e-95ec-b004d39a445f','bank' =>'SYARIAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a8524-94a7-45f1-b99b-db92ce33517b','bank' =>'BNI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a8533-2404-495d-98e5-3d7742349c4a','bank' =>'BRI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a8541-aebf-4b66-b98a-10166fe8e566','bank' =>'MAYBANK','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995a8553-5a51-4220-aaf8-dc652afddb4f','bank' =>'PANIN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Bank::create(['id' => '995fa148-8ba1-439b-b190-cbd5a5a32ca5','bank' =>'-','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
