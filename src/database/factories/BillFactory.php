<?php

namespace Database\Factories;

use App\Enums\Bill\BillStatus;
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
        return [
            'balance' => fake()->numberBetween(0, 10000000),
            'status' => BillStatus::getRandomValue(),
        ];
    }
}
