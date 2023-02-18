<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank_account>
 */
class BillFactory extends Factory
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

        return [
            //
            'balance' => fake()->numberBetween(0, 10000000),
            'status' => fake()->randomElement($status_arr),
        ];
    }
}
