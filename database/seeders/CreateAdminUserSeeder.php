<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Alf Briatna', 
            'user_id' => '996273d4-d3ba-4fb8-ad39-3c39efb9ce89',
            'email' => 'alf.briatna@gmail.com',
            'password' => bcrypt('12345678'),
            'nipeg' => '8908119P3B',
            'induk_id' => '995dd984-5913-49ff-9eb9-af2f67891d35',
            'unit_id' => '996180cb-7eb3-48f6-994b-654ccf117431',
            'dpd_id' => '995faf52-146d-4ff7-88fd-a02377a49289',
            'dpc_id' => '99618894-f9b0-4d2b-9159-9600152103ea',
            'alamat' => 'JL KINAGARA REGENCY BLOK R17 BUAH BATU',
            'created_at' => Carbon::now(),

        ]);
        
        $role = Role::create(['name' => 'SuperAdmin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
