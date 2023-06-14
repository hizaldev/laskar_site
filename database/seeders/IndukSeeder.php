<?php

namespace Database\Seeders;

use App\Models\Induk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class IndukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Induk::create(['code' => '00','induk' =>'KANTOR PUSAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '01','induk' =>'P2B','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '02','induk' =>'UNIT TRANSMISI JAWA BAGIAN BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '03','induk' =>'UNIT TRANSMISI JAWA BAGIAN TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '04','induk' =>'UNIT TRANSMISI JAWA BAGIAN TIMUR DAN BALI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '06','induk' =>'DISTRIBUSI JAWA TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '07','induk' =>'DISTRIBUSI BALI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '08','induk' =>'DISTRIBUSI LAMPUNG','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '09','induk' =>'WILAYAH ACEH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '10','induk' =>'WILAYAH SUMATERA UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '11','induk' =>'WILAYAH SUMATERA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '13','induk' =>'WILAYAH SUMATERA SELATAN JAMBI DAN BENGKULU','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '14','induk' =>'WILAYAH BANGKA BELITUNG','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '15','induk' =>'WILAYAH KALIMANTAN BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '16','induk' =>'WILAYAH KALIMANTAN SELATAN DAN KALIMANTAN TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '17','induk' =>'WILAYAH KALIMANTAN TIMUR DAN KALIMANTAN UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '18','induk' =>'WILAYAH SULAWESI SELATAN, SULAWESI TENGGARA DAN SULAWESI BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '19','induk' =>'WILAYAH SULAWESI UTARA, SULAWESI TENGAH DAN GORONTALO','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '20','induk' =>'WILAYAH MALUKU DAN MALUKU UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '21','induk' =>'WILAYAH PAPUA DAN PAPUA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '22','induk' =>'WILAYAH NUSA TENGGARA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '23','induk' =>'WILAYAH NUSA TENGGARA TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '24','induk' =>'UNIT PEMBANGKITAN SUMATERA BAGIAN UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '25','induk' =>'UNIT PEMBANGKITAN SUMATERA BAGIAN SELATAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '26','induk' =>'UNIT PEMBANGKITAN TANJUNG JATI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '27','induk' =>'UNIT INDUK PEMBANGUNAN PEMBANGKIT SUMATERA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '28','induk' =>'UNIT INDUK PEMBANGUNAN SUMATERA UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '29','induk' =>'UNIT INDUK PEMBANGUNAN SUMATERA SELATAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '30','induk' =>'UNIT INDUK PEMBANGUNAN SUMATERA TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '31','induk' =>'UNIT INDUK PEMBANGUNAN INTERKONEKSI SUMATERA JAWA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '32','induk' =>'UNIT INDUK PEMBANGUNAN JAWA BAGIAN BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '33','induk' =>'UNIT INDUK PEMBANGUNAN JAWA BAGIAN TIMUR I','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '34','induk' =>'UNIT INDUK PEMBANGUNAN JAWA BAGIAN TIMUR DAN BALI I','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '35','induk' =>'UNIT INDUK PEMBANGUNAN JAWA BAGIAN TIMUR DAN BALI II','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '36','induk' =>'UNIT INDUK PEMBANGUNAN KALIMANTAN BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '37','induk' =>'UNIT INDUK PEMBANGUNAN KALIMANTAN TIMUR','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '38','induk' =>'UNIT INDUK PEMBANGUNAN KALIMANTAN TENGAH','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '39','induk' =>'UNIT INDUK PEMBANGUNAN NUSA TENGGARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '40','induk' =>'UNIT INDUK PEMBANGUNAN SULAWESI UTARA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '41','induk' =>'UNIT INDUK PEMBANGUNAN SULAWESI SELATAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '42','induk' =>'UNIT INDUK PEMBANGUNAN PAPUA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '43','induk' =>'UNIT INDUK PEMBANGUNAN MALUKU','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '44','induk' =>'UNIT INDUK PEMBANGUNAN JAWA BAGIAN TIMUR II','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '45','induk' =>'P3B SUMATERA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '46','induk' =>'DISTRIBUSI JAKARTA RAYA','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '47','induk' =>'DISTRIBUSI JAWA BARAT','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '48','induk' =>'DISTRIBUSI BANTEN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '49','induk' =>'DISTRIBUSI JAWA TENGAH & DIY','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '50','induk' =>'PUSAT SERTIFIKASI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '51','induk' =>'PUSAT MANAJEMEN KONSTRUKSI','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '52','induk' =>'PUSAT PENDIDIKAN DAN LATIHAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '53','induk' =>'PUSAT PENELITIAN DAN PENGEMBANGAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '54','induk' =>'PUSAT ENJINIRING KETENAGALISTRIKAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
        Induk::create(['code' => '55','induk' =>'PUSAT PEMELIHARAAN KETENAGALISTRIKAN','created_by' => 'System', 'created_at' => Carbon::now() ]);
    }
}
