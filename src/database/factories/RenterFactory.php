<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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
            'bank_account_id' => function() {
                $bank_account = BankAccount::all()->random();
                if ($bank_account->type == 'personal') {
                    // если счет личный, то проверяем, есть ли у него уже арендатор
                    $renter = Renter::where('bank_account_id', $bank_account->id)->first();
                    // если арендатор уже есть, то выбираем другой счет
                    if ($renter) {
                        return Renter::factory()->create()->bank_account_id;
                    }
                }
                return $bank_account->id;
            },
            'first_name' => fake()->firstName(null),
            'middle_name' => fake()->firstName(null),
            'last_name' => fake()->lastName(),
            'status' => fake()->randomElement($status_arr),
            'phone_number' => fake()->numerify('##########'),
            'email' => fake()->safeEmail(),
            'passport' => fake()->unique()->numerify('#### ######'),
        ];

        // $busy_personal_accounts = Renter::all
        // $bank_accounts = Bank_account::all()->random();
        // $matched_accounts = Renter::where(['bank_account_id' => $bank_accounts->id])->get();

        // if ($bank_accounts->type == 'Личный' && $matched_accounts->isEmpty()) {
        //     return [
        //         'bank_account_id' => $bank_accounts->id,
        //         'first_name' => fake()->firstName(null),
        //         'middle_name' => fake()->firstName(null),
        //         'last_name' => fake()->lastName(),
        //         'status' => fake()->randomElement($status_arr),
        //         'phone_number' => fake()->numerify('##########'),
        //         'email' => fake()->safeEmail(),
        //         'passport' => fake()->unique()->numerify('#### ######'),
        //     ];
        // } else {
        //     $bank_accounts = Bank_account::all()->where('type', 'Корпоративный')->random();

        //     return [
        //         'bank_account_id' => $bank_accounts->id,
        //         'first_name' => fake()->firstName(null),
        //         'middle_name' => fake()->firstName(null),
        //         'last_name' => fake()->lastName(),
        //         'status' => fake()->randomElement($status_arr),
        //         'phone_number' => fake()->numerify('##########'),
        //         'email' => fake()->safeEmail(),
        //         'passport' => fake()->numerify('#### ######'),
        //     ];
        // }
    }
}
