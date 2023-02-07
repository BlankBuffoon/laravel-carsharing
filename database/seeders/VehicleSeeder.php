<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $status_arr = array(
        //     'На обслуживании',
        //     'В аренде',
        //     'Ожидание',
        // );

        // shuffle($status_arr);

        // $number_plate = Str::random(1) . ' ' . rand(1, 999) . ' ' . Str::random(2);
        // $location = '-' . rand(1, 99) . '.' . rand(1, 99999) . ' ' . '-' . rand(1, 99) . '.' . rand(1, 99999);

        // Vehicle::create([
        //     'manufacturer_id' => rand(1, 10),
        //     'status' => $status_arr[0],
        //     'model' => Str::random(8),
        //     'manufacture_date' => Carbon::today()->subDays(rand(0, 365)),
        //     'number_plate' => $number_plate,
        //     'location' => $location,
        //     'price' => rand(1000, 1000000),
        // ]);

        Vehicle::factory(20)->create();
    }
}
