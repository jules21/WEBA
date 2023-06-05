<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existVillage = \App\Models\Village::query()->first();

        if (!$existVillage) {
            //load village json file
            $json = file_get_contents(public_path('files/village.json'));
            $villages = json_decode($json);
            foreach ($villages as $village) {
                \App\Models\Village::create((array)$village);
            }
        }
    }
}
