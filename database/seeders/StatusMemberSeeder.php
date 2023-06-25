<?php

namespace Database\Seeders;

use App\Models\StatusMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StatusMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusMember::create(['id' => '994f84dc-e703-4a2e-9df2-c49571f31498','status' => 'Aktif','created_by' => 'System', 'created_at' => Carbon::now() ]);
        StatusMember::create(['id' => '994f863f-8d04-42d6-afd5-1bcc7e11a083','status' => 'Pensiun','created_by' => 'System', 'created_at' => Carbon::now() ]);
        StatusMember::create(['id' => '994f867e-14b9-4486-ab72-0bc07403f2e7','status' => 'Keluar Laskar','created_by' => 'System', 'created_at' => Carbon::now() ]);
        StatusMember::create(['id' => '994f869a-a91b-49c4-a412-b291d640b46f','status' => 'Meninggal','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
