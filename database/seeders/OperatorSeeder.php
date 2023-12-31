<?php

namespace Database\Seeders;

use App\Models\OperationArea;
use App\Models\Operator;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operator::factory(1)
            ->create();
    }
}
