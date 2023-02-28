<?php

namespace Tests\Feature;

use Database\Seeders\VehicleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehiclesApiTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = VehicleSeeder::class;

    /**
     * Тест метода index
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/api/vehicles');
        $response->assertStatus(200);
    }

    /**
     * Тест метода store
     *
     * @return void
     */
    public function test_store()
    {
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
    }

    public function test_show()
    {
        $response = $this->get('/api/vehicles/1');
        $response->assertStatus(200);
    }

    public function test_update()
    {
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
        $response = $this->delete('/api/vehicles/1');

        $response->assertStatus(200);
    }
}
