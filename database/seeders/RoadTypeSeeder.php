<?php

namespace Database\Seeders;

use App\Models\RoadType;
use Illuminate\Database\Seeder;

class RoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roadTypes = [
            'Concreted',
            'Gravelled',
            'Dirt',
            'Paved',
            'Unpaved',
        ];

        if (RoadType::query()->exists()) {
            return;
        }

        foreach ($roadTypes as $roadType) {
            RoadType::query()
                ->create([
                    'name' => $roadType,
                ]);
        }

    }
}
