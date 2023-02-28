<?php

namespace Database\Seeders;

use App\Models\LegalType;
use Illuminate\Database\Seeder;

class LegalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legalTypes = [
            ['id' => 1, 'name' => 'Company'],
            ['id' => 2, 'name' => 'Cooperative'],
            ['id' => 3, 'name' => 'NGO'],
            ['id' => 4, 'name' => 'Individual'],
            ['id' => 5, 'name' => 'Faith Based Organization'],
            ['id' => 6, 'name' => 'Political Party'],
            ['id' => 7, 'name' => 'Government'],
            ['id' => 8, 'name' => 'UN Agency'],
            ['id' => 9, 'name' => 'Diplomatic Mission'],
            ['id' => 10, 'name' => 'International Organisation'],
        ];

        collect($legalTypes)->each(function ($legalType) {
            LegalType::query()->updateOrCreate($legalType);
        });
    }
}
