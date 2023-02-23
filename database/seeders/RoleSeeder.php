<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['name' => 'super-admin','guard_name' => 'web', 'description' => 'Super Admin']);
        Role::updateOrCreate(['name' => 'operator-admin','guard_name' => 'web', 'description' => 'Operator Admin']);
    }
}
