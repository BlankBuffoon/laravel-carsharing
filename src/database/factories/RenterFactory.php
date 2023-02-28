<?php

namespace Database\Factories;

use App\Enums\Renter\RenterStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Renter>
 */
class RenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(null),
            'middle_name' => fake()->firstName(null),
            'last_name' => fake()->lastName(),
            'status' => RenterStatus::getRandomValue(),
            'phone_number' => fake()->unique()->numerify('79########'),
            'email' => fake()->unique()->safeEmail(),
            'passport' => fake()->unique()->numerify('#### ######'),
        ];
    }
}
