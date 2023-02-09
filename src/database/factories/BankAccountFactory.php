<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank_account>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status_arr = array(
            'open',
            'blocked',
            'frozen',
            'closed',
        );

        $types_arr = array (
            'personal',
            'corporated',
        );

        return [
            //
            'balance' => fake()->numberBetween(0, 1000000),
            'status' => fake()->randomElement($status_arr),
            'type' => fake()->randomElement($types_arr),
        ];
    }
}
