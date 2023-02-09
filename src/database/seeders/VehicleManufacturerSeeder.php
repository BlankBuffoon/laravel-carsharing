<?php

namespace Database\Seeders;

use App\Models\VehicleManufacturer;
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
            VehicleManufacturer::create([
                'name' => $manufacturer_name,
            ]);
        }
    }
}
