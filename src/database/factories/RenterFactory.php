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
            'Активен',
            'Заморожен',
            'Заблокирован',
            'Премиум',
        );

        $bank_accounts = BankAccount::all()->shuffle()->first();
        $matched_accounts = Renter::where('bank_account_id', $bank_accounts->id)->count();

        if ($bank_accounts->type == 'Личный' && $matched_accounts == 0) {
            return [
                'bank_account_id' => $bank_accounts->id,
                'first_name' => fake()->firstName(null),
                'middle_name' => fake()->firstName(null),
                'last_name' => fake()->lastName(),
                'status' => fake()->randomElement($status_arr),
                'phone_number' => fake()->numerify('##########'),
                'email' => fake()->safeEmail(),
                'passport' => fake()->numerify('#### ######'),
            ];
        } else {
            $bank_accounts = BankAccount::all()->where('type', 'Корпоративный')->shuffle()->first();

            return [
                'bank_account_id' => $bank_accounts->id,
                'first_name' => fake()->firstName(null),
                'middle_name' => fake()->firstName(null),
                'last_name' => fake()->lastName(),
                'status' => fake()->randomElement($status_arr),
                'phone_number' => fake()->numerify('##########'),
                'email' => fake()->safeEmail(),
                'passport' => fake()->numerify('#### ######'),
            ];
        }


        // foreach ($other_accounts as $account) {
        //     return [
        //         'bank_account_id' => $account->id,
        //         'first_name' => fake()->firstName(null),
        //         'middle_name' => fake()->firstName(null),
        //         'last_name' => fake()->lastName(),
        //         'status' => fake()->randomElement($status_arr),
        //         'phone_number' => fake()->numerify('##########'),
        //         'email' => fake()->safeEmail(),
        //         'passport' => fake()->numerify('#### ######'),
        //     ];
        // }

        // return [
        //     'bank_account_id' => fake()->randomElement($corporated_accounts)->id,
        //     'first_name' => fake()->firstName(null),
        //     'middle_name' => fake()->firstName(null),
        //     'last_name' => fake()->lastName(),
        //     'status' => fake()->randomElement($status_arr),
        //     'phone_number' => fake()->numerify('##########'),
        //     'email' => fake()->safeEmail(),
        //     'passport' => fake()->numerify('#### ######'),
        // ];
    }
}
