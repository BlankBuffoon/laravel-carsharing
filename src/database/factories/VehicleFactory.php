<?php

namespace Database\Factories;

use App\Models\Vehicle;
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
            'maintenance',
            'expectation',
        );

        // Генерируем Российский номерной знак
        do {
            $letters = ['A', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У'];

            $licensePlate =
                $letters[array_rand($letters)] .
                rand(0, 999) .
                $letters[array_rand($letters)] .
                $letters[array_rand($letters)] .
                ' ' .
                rand(10, 199);
        }
        // Защита на случай если сгенерируется два одинаковых номера (один на миллион)
        while (!Vehicle::all()->where('license_plate', $licensePlate));

        return [
            'vehicle_model_id' => fake()->numberBetween(1, 21),
            'status' => fake()->randomElement($status_arr),
            'mileage' => fake()->randomNumber(6),
            'manufacture_year' => fake()->year('now', '1990'),
            'location' => fake()->randomFloat(4, -35, -50) . ' ' . fake()->randomFloat(4, -35, -50),
            'license_plate' => $licensePlate,
            'price_at_minute' => fake()->numberBetween(75, 1350),
        ];
    }
}
