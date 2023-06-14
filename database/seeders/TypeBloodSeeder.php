<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TypeBloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeBlood::create(['id' => '994d5888-c5a4-4a5c-a983-a0664ada24b6','golongan_darah' =>'B','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995a83b5-af2b-48cf-8df0-1e7b29867b02','golongan_darah' =>'A','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995a83be-0439-46c5-8da5-4ce25aa1b29f','golongan_darah' =>'AB','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995a83cc-9c93-4b10-ba9a-c651ae15102d','golongan_darah' =>'O','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995fac48-8758-4fa8-8a9f-5c3361a1e5bd','golongan_darah' =>'A+','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995fac51-1ae1-4423-a6d3-a2428a8fa311','golongan_darah' =>'B+','created_by' => 'System', 'created_at' => Carbon::now() ]);
        TypeBlood::create(['id' => '995fac57-e405-4625-8cf6-e6e46511a6ef','golongan_darah' =>'-','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
