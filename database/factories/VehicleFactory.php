<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $faker = Faker::create();

        $status_arr = array(
            'На обслуживании',
            'В аренде',
            'Ожидание',
        );

        shuffle($status_arr);

        $number_plate = Str::random(1) . ' ' . rand(1, 999) . ' ' . Str::random(2);
        $location = '-' . rand(1, 99) . '.' . rand(1, 99999) . ' ' . '-' . rand(1, 99) . '.' . rand(1, 99999);

        return [
            'manufacturer_id' => rand(1, 10),
            'status' => $status_arr[0],
            'model' => Str::random(8),
            'manufacture_date' => $this->faker->date(),
            'number_plate' => $number_plate,
            'location' => $location,
            'price' => rand(1000, 1000000),
        ];
    }
}
