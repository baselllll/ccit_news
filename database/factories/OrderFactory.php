<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Services\GenerateCodeService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customers = Customer::count();
        return [
            'customer_id' => $this->faker->numberBetween(1, $customers),
            'tailor_id' => $this->faker->numberBetween(1, $customers),
            'delivery_date' => $this->faker->dateTimeBetween('now','+30 days'),
            'code' => GenerateCodeService::randomCode(),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'clothes_num' => $this->faker->numberBetween(1,50),
            'deposit' => $this->faker->numberBetween(100,2000),
            'total_price' => $this->faker->numberBetween(2000,10000),
            'status' => 'incomplete',
            'comment' => 'initial comment',
        ];
    }
}
