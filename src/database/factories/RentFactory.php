<?php

namespace Database\Factories;

use App\Enums\Rent\RentStatus;
use App\Enums\Vehicle\VehicleStatus;
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

        $status = RentStatus::getRandomValue();

        // Если статус аренды "открыта", делаем так чтобы она не сгенерировалась годом ранее
        if ($status == RentStatus::Open) {
            $beginDateTime = fake()->dateTimeBetween($startDate = '-1 days', $endDate = 'now', $timezone = null);
        } else {
            $beginDateTime = fake()->dateTimeBetween($startDate = '-365 days', $endDate = 'now', $timezone = null);
        }

        // Генерируем дату конца аренды, где максимальное значение - 1 день от начала
        $endDateTime = fake()->dateTimeInInterval($beginDateTime, $endDate = '+1 days', $timezone = null);

        return [
            'vehicle_id' => function () use ($status) {
                if ($status == 'open') {
                    return Vehicle::factory()->create(['status' => VehicleStatus::Rented])->id;
                } else {
                    return Vehicle::factory()->create()->id;
                }
            },
            'renter_id' => Renter::all()->whereNotNull('default_bill')->random(),
            'status' => $status,
            'begin_datetime' => $beginDateTime,
            'end_datetime' => function () use ($status, $endDateTime) {
                if ($status === RentStatus::Open) {
                    return null;
                } else {
                    return $endDateTime;
                }
            },
        ];

    }
}
