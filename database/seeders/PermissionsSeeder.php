<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Create Role', 'Read Role', 'Update Role', 'Delete Role',
            'Create Permission', 'Read Permission', 'Update Permission', 'Delete Permission',
            'Create Mobil', 'Read Mobil', 'Update Mobil', 'Delete Mobil',
            'Create Sewa', 'Read Sewa', 'Update Sewa', 'Delete Sewa',
            'Create Laporan', 'Read Laporan', 'Update Laporan', 'Delete Laporan',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}