<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'contact_person_name' => $this->faker->userName,
            'contact_person_phone' => $this->faker->phoneNumber,
            'contact_person_email' => $this->faker->unique()->safeEmail,
            'district_id' => \Helper::getRandomModelId(District::class),
            'operator_id' => \Helper::getRandomModelId(Operator::class),
        ];
    }
}
