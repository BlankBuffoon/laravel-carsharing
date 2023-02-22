<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(VehicleManufacturerSeeder::class);
        $this->call(VehicleBrandSeeder::class);
        $this->call(VehicleModelSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(RenterSeeder::class);
        $this->call(BillRenterSeeder::class);
        $this->call(RentSeeder::class);
        $this->call(TransactionSeeder::class);

        // $this->call(ManufacturerSeeder::class);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
