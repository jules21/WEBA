<?php

namespace Database\Factories;

use App\Models\ItemCategory;
use App\Models\PackagingUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
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
            'description' => $this->faker->text,
            'item_category_id' => ItemCategory::inRandomOrder()->first()->id,
            'packaging_unit_id' => PackagingUnit::inRandomOrder()->first()->id,
            'selling_price' => $this->faker->randomFloat(2, 0, 50000),
            'is_active' => $this->faker->boolean,
            'vatable' => $this->faker->boolean,
            'vat_rate' => 18,
        ];
    }
}
