<?php

namespace Database\Seeders;

use App\Models\VehicleBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $brands = array(
            1 => ['Audi', 'Porsche', 'Volkswagen'],
            2 => ['Cadillac', 'Chevrolet'],
            3 => ['Jeep', 'Ferrari'],
            4 => ['Mercedes-Benz'],
            5 => ['BMW', 'Rolls-Royce'],
        );

        foreach ($brands as $key => $value) {
            foreach ($value as $brand_name) {
                VehicleBrand::create([
                    'name' => $brand_name,
                    'vehicle_manufacturer_id' => $key,
                ]);
            }
        }
    }
}
