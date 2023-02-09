<?php

namespace Database\Factories;

use App\Models\BankAccount;
use App\Models\Renter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\renter_bank_account>
 */
class RenterBankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bank_account_id' => function () {
                return BankAccount::factory()->create()->id;
            },
            'renter_id' => function () {
                return Renter::factory(2)->create()->id;
            },
        ];
    }
}
