<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(LegalTypeSeeder::class);
        $this->call(OperatorSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(InstitutionSeeder::class);
        $this->call(UserSeeder::class);

    }
}
