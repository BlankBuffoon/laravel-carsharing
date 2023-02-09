<?php

namespace Database\Seeders;

use App\Models\Vehicle_manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $manufacturers_names = array(
            'VAG',
            'General Motors',
            'FCA',
            'Daimler',
            'BMW',
        );

        foreach ($manufacturers_names as $manufacturer_name) {
            Vehicle_manufacturer::create([
                'name' => $manufacturer_name,
            ]);
        }
    }
}
