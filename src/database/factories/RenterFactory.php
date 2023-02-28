<?php

namespace Database\Factories;

use App\Models\BankAccount;
use App\Models\Renter;
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
        $status_arr = array (
            'active',
            'frozen',
            'blocked',
            'premium',
        );

        return [
            'first_name' => fake()->firstName(null),
            'middle_name' => fake()->firstName(null),
            'last_name' => fake()->lastName(),
            'status' => fake()->randomElement($status_arr),
            'phone_number' => fake()->unique()->numerify('79########'),
            'email' => fake()->unique()->safeEmail(),
            'passport' => fake()->unique()->numerify('#### ######'),
        ];
    }
}
