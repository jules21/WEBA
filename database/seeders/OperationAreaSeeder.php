<?php

namespace Database\Seeders;

use App\Models\OperationArea;
use Illuminate\Database\Seeder;

class OperationAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OperationArea::factory(10)->create();
    }
}
