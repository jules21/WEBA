<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = [
            ['id' => 1, 'name' => 'rura'],
            ['id' => 2, 'name' => 'district'],
        ];

        if (! Institution::query()->exists()) {
            foreach ($institutions as $institution) {
                Institution::query()->create($institution);
            }
        }
    }
}
