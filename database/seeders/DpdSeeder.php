<?php

namespace Database\Seeders;

use App\Models\Dpd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dpd::create(['id' => '9961881a-7b25-4376-8c69-08a6235e18e7','dpd' =>'-','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-0d80-42a0-9507-8caff496c1d8','dpd' =>'P2B','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1422-4e06-8186-2c406f465da5','dpd' =>'PLN KANTOR PUSAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '99604232-f770-493a-bf60-98c1b8497ba9','dpd' =>'TRANSMISI JAWA BAGIAN BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-146d-4ff7-88fd-a02377a49289','dpd' =>'TRANSMISI JAWA BAGIAN TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-149d-4aeb-bba3-33bd87bc4740','dpd' =>'TRANSMISI JAWA BAGIAN TIMUR & BALI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-14ca-45f1-ad50-8373c3971e08','dpd' =>'DISTRIBUSI JAWA TENGAH & DIY','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-14ff-4b3f-86ff-56a6ea545ab1','dpd' =>'UNIT PEMBANGKITAN SUMATERA BAGIAN SELATAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1653-4feb-b39e-a348f90aaad6','dpd' =>'DISTRIBUSI LAMPUNG','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1697-4429-9ca1-44ae610aa518','dpd' =>'DISTRIBUSI JAWA TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1759-4fc0-a99c-91f4340617a4','dpd' =>'DISTRIBUSI JAKARTA RAYA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1797-4ed8-9e69-9a5fa56687da','dpd' =>'WILAYAH SUMATERA UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-17ce-4429-8339-45c36a2dbf6f','dpd' =>'DISTRIBUSI BANTEN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1807-488c-a3b6-d1bafae0d0e7','dpd' =>'WILAYAH PAPUA DAN PAPUA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-183f-4a23-bebf-de93a8581fc1','dpd' =>'WILAYAH NUSA TENGGARA TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1876-44ab-ac63-837c827d0d95','dpd' =>'WILAYAH BANGKA BELITUNG','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-18ad-4325-b87a-c7f33007efea','dpd' =>'TRAINING','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-18e4-4968-a3b0-1d9a1a676042','dpd' =>'PUSDIKLAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-191b-4806-a134-154cf5fcea9d','dpd' =>'UNIT PEMBANGKITAN SUMATERA BAGIAN UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1956-4540-9e24-94ca0870cc4b','dpd' =>'UNIT INDUK PEMBANGUNAN PEMBANGKIT SUMATERA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1990-4b5b-9c18-f50956755b4a','dpd' =>'UNIT INDUK PEMBANGUNAN SULAWESI SELATAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1a12-4b4c-8c33-6a9162c59e9e','dpd' =>'UNIT INDUK PEMBANGUNAN SUMATERA TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1a4b-4dc7-a7f7-79ae868230dc','dpd' =>'UNIT INDUK PEMBANGUNAN INTERKONEKSI SUMATERA JAWA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1a8a-4682-a113-eb439b909b8c','dpd' =>'DISTRIBUSI JAWA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Dpd::create(['id' => '995faf52-1abb-43ee-88c5-85138adf2a93','dpd' =>'UNIT INDUK PEMBANGUNAN KALIMANTAN TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
