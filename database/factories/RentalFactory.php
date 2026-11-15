<?php

namespace Database\Factories;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'startDate' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'endDate' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'totalPrice' => fake()->randomFloat(2, 10, 100),
            'user_id' => $this->faker->numberBetween(1,5),
            'equipment_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
