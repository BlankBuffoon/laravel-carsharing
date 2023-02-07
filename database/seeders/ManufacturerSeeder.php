<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use App\Models\Manufacturer;

class ManufacturerSeeder extends Seeder
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
            'BMW',
            'Tesla',
            'Hyndai',
            'Mersedes',
            'Volvo',
            'Nissan',
            'Audi',
            'Range Rover',
            'McLarren',
            'Toyota',
        );

        foreach ($manufacturers_names as $manufacturer_name) {
            Manufacturer::create([
                'name' => $manufacturer_name,
            ]);
        }
    }
}
