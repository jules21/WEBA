<?php

namespace Database\Seeders;

use App\Models\WaterUsage;
use Illuminate\Database\Seeder;

class WaterUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waterUsage = [
            'Institution',
            'Residential',
            'Hospital',
            'Breeding'
        ];

        if (WaterUsage::query()->exists())
            return;

        foreach ($waterUsage as $usage) {
            WaterUsage::query()
                ->create([
                    'name' => $usage
                ]);
        }
    }
}
