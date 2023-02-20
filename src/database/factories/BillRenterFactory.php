<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\BillRenter;
use App\Models\Renter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BillRenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            //

            'renter_id' => function () {
                return Renter::all()->random()->id;
            },

            'bill_id' => function () {                
                return Bill::all()->random()->id;
            },

            
        ];
    }
}
