<?php

namespace Database\Seeders;

use App\Models\RoadCrossType;
use Illuminate\Database\Seeder;

class RoadCrossTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            "Gravel or dirt",
            "Swamp",
            "Ruhurura",
            "River",
            "Strong fence",
            "Other people's lands"
        ];

        if (RoadCrossType::query()->exists())
            return;

        foreach ($types as $type) {
            RoadCrossType::query()
                ->create([
                    'name' => $type
                ]);
        }
    }
}
