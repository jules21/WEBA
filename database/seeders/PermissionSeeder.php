<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions  = [
            ['name'=>'Manage Users','guard_name'=>'web'],
            ['name'=>'Manage Roles','guard_name'=>'web'],
            ['name'=>'Manage Permissions','guard_name'=>'web'],
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::query()->updateOrCreate(['name'=>data_get($permission, 'name')],$permission);
        }
    }
}
