<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\WaterNetworkStatus;
use App\Models\WaterNetworkType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaterNetworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName,
            'distance_covered' => $this->faker->randomFloat(2, 0, 1000),
            'population_covered' => $this->faker->numberBetween(0, 1000000),
            'water_network_type_id' => WaterNetworkType::factory(),
            'water_network_status_id' => WaterNetworkStatus::factory(),
            'district_id' => District::query()->inRandomOrder()->first()->id,
        ];
    }
}
