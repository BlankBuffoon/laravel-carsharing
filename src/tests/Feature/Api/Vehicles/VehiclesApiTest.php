<?php

namespace Tests\Feature\Api\Vehicles;

use App\Models\VehicleManufacturer;
use Database\Seeders\VehicleManufacturerSeeder;
use Database\Seeders\VehicleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\Feature\Api\ApiTest;
use Tests\TestCase;

class VehiclesApiTest extends ApiTest
{
    // use CreatesApplication;
    // use RefreshDatabase;
    // use DatabaseTransactions;

    // protected $seeder = VehicleSeeder::class;

    // protected $seeder = VehicleSeeder::class;
    // protected $seed = true;

    // protected function setUp() : void
    // {
    //     parent::setUp();

    //     // сидеры для второго класса
    //     $this->seed(VehicleSeeder::class);
    // }

    /**
     * Тест метода index
     *
     * @return void
     */
    public function test_index()
    {
        // $this->seed(VehicleSeeder::class);
        // dump(VehicleManufacturer::all());
        // $this->seed();
        // $this->seed([
        //     VehicleManufacturerSeeder::class,
        //     VehicleBrandSeeder::class,
        //     VehicleModelSeeder::class,
        // ]);
        // Vehicle::factory(3)->create();

        $response = $this->get('/api/vehicles');
        $response->assertStatus(200);
        // $response->assertJsonStructure([
        //     '*' => [
        //         'idasd',
        //         'vehicle_model_id',
        //         'status',
        //         'mileage',
        //         'manufacture_year',
        //         'location',
        //         'license_plate',
        //         'price_at_minute',
        //     ],
        // ]);
    }

    /**
     * Тест метода store
     *
     * @return void
     */
    public function test_store()
    {
        // $this->seed(VehicleSeeder::class);
        // dump(VehicleManufacturer::all());
        // $this->seed();
        // $this->seed([
        //     VehicleManufacturerSeeder::class,
        //     VehicleBrandSeeder::class,
        //     VehicleModelSeeder::class,
        // ]);

        $data = [
            "vehicle_model_id" => 1,
            "mileage" => 4300,
            "manufacture_year" => 2010,
            "location" => "-41.201 -59.8371",
            "license_plate" => "А999МР 179",
            "price_at_minute" => 400000
        ];

        $response = $this->json('POST', '/api/vehicles', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "message" => "Succesfully created",
            "1" => [
                "vehicle_model_id",
                "mileage",
                "manufacture_year",
                "location",
                "license_plate",
                "price_at_minute",
                "updated_at",
                "created_at",
                "id"
            ]
        ]);
    }

    public function test_show()
    {
        // $this->seed();
        $response = $this->get('/api/vehicles/1');
        $response->assertStatus(200);
    }

    public function test_update()
    {
        // $this->seed();
        $data = [
            "vehicle_model_id" => 1,
            "status" => "maintenance",
            "mileage" => 4300,
            "manufacture_year" => 2010,
            "location" => "-41.201 -59.8371",
            "license_plate" => "А999МР 179",
            "price_at_minute" => 400000
        ];

        $response = $this->json('PATCH', '/api/vehicles/1', $data);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        // $this->seed();
        $response = $this->delete('/api/vehicles/1');

        $response->assertStatus(200);
    }
}
