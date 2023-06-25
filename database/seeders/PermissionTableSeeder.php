<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'settings_role-list',
            'settings_role-create',
            'settings_role-edit',
            'settings_role-delete',
            'settings_permissions-list',
            'settings_permissions-create',
            'settings_permissions-edit',
            'settings_permissions-delete',
            'master_dpd-list',
            'master_dpd-create',
            'master_dpd-edit',
            'master_dpd-delete',
            'master_dpc-list',
            'master_dpc-create',
            'master_dpc-edit',
            'master_dpc-delete',
            'master_agama-list',
            'master_agama-create',
            'master_agama-edit',
            'master_agama-delete',
            'master_kota-list',
            'master_kota-create',
            'master_kota-edit',
            'master_kota-delete',
            'master_ukuran-list',
            'master_ukuran-create',
            'master_ukuran-edit',
            'master_ukuran-delete',
            'master_golongan_darah-list',
            'master_golongan_darah-create',
            'master_golongan_darah-edit',
            'master_golongan_darah-delete',
            'master_bank-list',
            'master_bank-create',
            'master_bank-edit',
            'master_bank-delete',
            'master_status_member-list',
            'master_status_member-create',
            'master_status_member-edit',
            'master_status_member-delete',
            'master_unit-list',
            'master_unit-create',
            'master_unit-edit',
            'master_unit-delete',
            'master_unit-show',
            'keanggotaan_proses_daftar-list',
            'keanggotaan_proses_daftar-edit',
            'keanggotaan_proses_daftar-delete',
            'keanggotaan_anggota-list',
            'keanggotaan_anggota-create',
            'keanggotaan_anggota-edit',
            'keanggotaan_anggota-delete',
            'keanggotaan_anggota-show',
            'settings-user-list',
            'settings-user-edit',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
