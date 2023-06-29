<?php

namespace Database\Factories;

use App\Models\WaterNetworkType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WaterNetworkTypeFactory extends Factory
{
    protected $model = WaterNetworkType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'unit_price' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
