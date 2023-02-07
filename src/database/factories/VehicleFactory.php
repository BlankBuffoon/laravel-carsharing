<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status_arr = array(
            'На обслуживании',
            'В аренде',
            'Ожидание',
        );

        return [
            'vehicle_model_id' => fake()->numberBetween(1, 21),
            'status' => fake()->randomElement($status_arr),
            'mileage' => fake()->randomNumber(6),
            'manufacture_year' => fake()->year('now', '1990'),
            'location' => fake()->randomFloat(4, -35, -50) . ' ' . fake()->randomFloat(4, -35, -50),
            'license_plate' => fake()->bothify('?###??'),
            'price_at_hour' => fake()->numberBetween(4500, 80000),
        ];
    }
}
