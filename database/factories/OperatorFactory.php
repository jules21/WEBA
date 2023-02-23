<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\LegalType;
use App\Models\Province;
use App\Models\Sector;
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
        return [
            "name"=>$this->faker->name,
            "legal_type_id"=> \Helper::getRandomModelId(LegalType::class),
            "id_type"=>["passport","national_id","driving_license","other"][rand(0,3)],
            "doc_number"=>$this->faker->randomDigit(),
            "address"=>$this->faker->address,
            "province_id"=>24,
            "district_id"=>16,
            "sector_id"=>16,
            "cell_id"=>null,
            "village_id"=>null,
        ];
    }
}
