<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserDppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(['user_id'=>'996273d1-142a-4e68-b9cc-e57d26b68d81','unit_id' => '996180cb-717b-40c8-9a65-3026c2ad1d79', 'alamat'=>'PERUM DIPONEGORO B17 KLATEN', 'name'=>'ADI GUNAWAN','email'=>'emaileadi@gmail.com', 'nipeg'=>'8306080P3B', 'dpd_id'=>'9961881a-7b25-4376-8c69-08a6235e18e7', 'dpc_id'=>'99618894-f9b0-4d2b-9159-9600152103ea','password' => bcrypt('P@ss4Laskar') ,'created_at' => Carbon::now() ]);
        $user1 = User::create(['user_id'=>'996273d1-88f5-41ee-b689-434b42fa4a22','unit_id' => '996180cb-7b9c-4e4d-a492-3f3dd38461c2', 'alamat'=>'JL. AMARTA RAYA BLOK O 5 PERUM ABDI NEGARA BOJANEGARA', 'name'=>'ARWAN SANNI','email'=>'arwan_sanni@pln.co.id', 'nipeg'=>'8306077P3B', 'dpd_id'=>'9961881a-7b25-4376-8c69-08a6235e18e7', 'dpc_id'=>'99618894-f9b0-4d2b-9159-9600152103ea','password' => bcrypt('P@ss4Laskar') ,'created_at' => Carbon::now() ]);
        $user2 = User::create(['user_id'=>'996273d3-1dc6-4ac4-9300-b014a38531bd','unit_id' => '996180cb-7b70-47fa-afa5-1d1cb626a13f', 'alamat'=>'JL. SIAK BLOK J5/11 RT.01 RW.07 KOMP. BEACUKAI', 'name'=>'TONNY FERDINANTO','email'=>'TONNY_F@PLN.CO.ID', 'nipeg'=>'7906125Z', 'dpd_id'=>'9961881a-7b25-4376-8c69-08a6235e18e7', 'dpc_id'=>'99618894-f9b0-4d2b-9159-9600152103ea','password' => bcrypt('P@ss4Laskar') ,'created_at' => Carbon::now() ]);
        $user3 = User::create(['user_id'=>'996273d3-c8d3-4532-9945-c6fd8cee7ab5','unit_id' => '996180cb-89b3-4b7f-bbb0-fba63f70356b', 'alamat'=>'NGRAU BOKOHARJO NO 1 RT 1 DIY', 'name'=>'RACHMAWATY','email'=>'rachmawati@pln.co.id', 'nipeg'=>'7494233B', 'dpd_id'=>'9961881a-7b25-4376-8c69-08a6235e18e7', 'dpc_id'=>'99618894-f9b0-4d2b-9159-9600152103ea','password' => bcrypt('P@ss4Laskar') ,'created_at' => Carbon::now() ]);
        $user4 = User::create(['user_id'=>'996273d6-5455-4bad-9d6f-df7cec7942ef','unit_id' => '996180cb-a4c4-4faa-bfb9-61684876e25d', 'alamat'=>'DS SUAK RIBEE KEC JOHAN PAHDONGU ACEH', 'name'=>'MUHAMMAD IMAM MUSTHAFA','email'=>'m.imam@pln.co.id', 'nipeg'=>'9513035NY', 'dpd_id'=>'9961881a-7b25-4376-8c69-08a6235e18e7', 'dpc_id'=>'99618894-f9b0-4d2b-9159-9600152103ea','password' => bcrypt('P@ss4Laskar') ,'created_at' => Carbon::now() ]);
        $user->assignRole(['2']);
        $user2->assignRole(['2']);
        $user3->assignRole(['2']);
        $user4->assignRole(['2']);
        $user1->assignRole(['2']);
    }
}
