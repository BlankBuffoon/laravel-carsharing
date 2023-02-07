<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank_account>
 */
class Bank_accountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status_arr = array(
            'Открыт',
            'Заблокирован',
            'Заморожен',
            'Закрыт',
        );

        $types_arr = array (
            'Личный',
            'Корпоративный',
        );

        return [
            //
            'balance' => fake()->numberBetween(0, 1000000),
            'status' => fake()->randomElement($status_arr),
            'type' => fake()->randomElement($types_arr),
        ];
    }
}
