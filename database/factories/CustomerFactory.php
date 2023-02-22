<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'additional_phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'clothes_num' => $this->faker->numberBetween(1,50),
            'special_customer' => $this->faker->boolean(),
        ];
    }
}
