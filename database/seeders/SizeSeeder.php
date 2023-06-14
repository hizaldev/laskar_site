<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create(['id' => '994b837e-0ea2-4b65-b8fe-b1d2dbecc093','ukuran' =>'L','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995a84bb-0ad4-4d2e-a380-0e2ed618be68','ukuran' =>'S','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995a84c6-4b87-4df6-982c-d5e72dc12c04','ukuran' =>'M','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995a84d1-e28e-43ba-9bd3-418656619118','ukuran' =>'XL','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995a84db-b1b2-46a6-aad4-e91706ea53ed','ukuran' =>'XXL','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995a84e4-a15b-41c7-8447-04119e7f6c6e','ukuran' =>'XXXL','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Size::create(['id' => '995fa875-e6e4-4008-a9fe-48786cc13539','ukuran' =>'-','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
