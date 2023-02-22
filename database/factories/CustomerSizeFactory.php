<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerSize>
 */
class CustomerSizeFactory extends Factory
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
            'customer_id' => $this->faker->unique()->numberBetween(1, $customers),
            'D1_TawlAmam' => $this->faker->numberBetween(1,120),
            'D2_Katef' => $this->faker->numberBetween(1,120),
            'D3_YadSadda' => $this->faker->numberBetween(1,120),
            'D4_WasaWest' => $this->faker->numberBetween(1,120),
            'D5_RaqabaKalab' => $this->faker->numberBetween(1,120),
            'D6_WasaYad' => $this->faker->numberBetween(1,120),
            'D7_Mafsal' => $this->faker->numberBetween(1,120),
            'D8_Ibet' => $this->faker->numberBetween(1,120),
            'D9_BodKabk' => $this->faker->numberBetween(1,120),
            'D10_Note1' => $this->faker->numberBetween(1,120),
            'D11_TawlKalf' => $this->faker->numberBetween(1,120),
            'D12_TanzeletKatf' => $this->faker->numberBetween(1,120),
            'D13_YadKabak' => $this->faker->numberBetween(1,120),
            'D14_Sader' => $this->faker->numberBetween(1,120),
            'D15_Raqaba_Sada' => $this->faker->numberBetween(1,120),
            'D16_WasatYad' => $this->faker->numberBetween(1,120),
            'D17_Khaser' => $this->faker->numberBetween(1,120),
            'D18_Takhales' => $this->faker->numberBetween(1,120),
            'D19_Khatwa' => $this->faker->numberBetween(1,120),
            'D20_Note2' => $this->faker->numberBetween(1,120),
            'D21_Raqaba' => $this->faker->numberBetween(1,120),
            'D22_Jabzor' => $this->faker->numberBetween(1,120),
            'D23_Kabak' => $this->faker->numberBetween(1,120),
            'D24_JeebJanby' => $this->faker->numberBetween(1,120),
            'D25_Jeeb' => $this->faker->numberBetween(1,120),
            'D26_Weight' => $this->faker->numberBetween(1,120),
        ];
    }
}
