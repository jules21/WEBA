<?php

namespace Database\Factories;

use App\Models\LegalType;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cell = \App\Models\Cell::query()->first();
        return [
            'name' => "WASAC",
            'legal_type_id' => LegalType::query()->first()->id,
            'id_type' => ['passport', 'national_id', 'tin_number'][rand(0, 3)],
            'doc_number' => mt_rand(100000000, 999999999),
            'address' => $this->faker->address,
            'province_id' => $cell->sector->district->province_id,
            'district_id' => $cell->sector->district_id,
            'sector_id' => $cell->sector_id,
            'cell_id' => $cell->id,
            'village_id' => null,
        ];
    }
}
