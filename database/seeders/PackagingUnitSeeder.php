<?php

namespace Database\Seeders;

use App\Models\PackagingUnit;
use Illuminate\Database\Seeder;

class PackagingUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = ['BAG', 'BOX', 'BOTTLE', 'CAN', 'DRUM', 'JAR', 'TIN', 'TUBE', 'PIECE', 'KG', 'OTHER'];
        if (PackagingUnit::count() > 0) {
            return;
        }
        foreach ($units as $unit) {
            PackagingUnit::create([
                'name' => $unit
            ]);
        }

    }
}
