<?php

namespace Database\Factories;

use App\Models\Renter;
use App\Models\Transaction;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $statuses = array(
            'open',
            'closed'
        );

        $beginDateTime = fake()->dateTimeBetween($startDate = '-365 days', $endDate = 'now', $timezone = null);
        $endDateTime = fake()->dateTimeInInterval($beginDateTime, $endDate = '+1 days', $timezone = null);

        $status = $statuses[rand(0, 1)];

        return [
            'vehicle_id' => function () use ($status) {
                if ($status == 'open') {
                    return Vehicle::factory()->create(['status' => 'rented'])->id;
                } else {
                    return Vehicle::factory()->create()->id;
                }
            },
            'renter_id' => Renter::all()->whereNotNull('default_bill')->random(),
            'status' => $status,
            'begin_datetime' => $beginDateTime,
            'end_datetime' => function () use ($status, $endDateTime) {
                if ($status === "open") {
                    return null;
                } else {
                    return $endDateTime;
                }
            },
        ];

    }
}
