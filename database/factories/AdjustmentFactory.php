<?php

namespace Database\Factories;

use App\Models\Adjustment;
use App\Models\OperationArea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdjustmentFactory extends Factory
{
    protected $model = Adjustment::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'attachment' => $this->faker->word(),
            'return_back_status' => $this->faker->word(),

            'operation_area_id' => OperationArea::factory(),
            'created_by' => User::factory(),
            'approved_by' => User::factory(),
        ];
    }
}
