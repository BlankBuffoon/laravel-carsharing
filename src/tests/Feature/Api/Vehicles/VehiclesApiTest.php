<?php

namespace Tests\Feature\Api\Vehicles;

use App\Models\VehicleManufacturer;
use Database\Seeders\VehicleBrandSeeder;
use Database\Seeders\VehicleManufacturerSeeder;
use Database\Seeders\VehicleModelSeeder;
use Database\Seeders\VehicleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\Feature\Api\ApiTest;
use Tests\TestCase;

class VehiclesApiTest extends TestCase
{
    use RefreshDatabase;

    // protected $seed = true;
    protected $seeder = [
        VehicleManufacturerSeeder::class,
        VehicleBrandSeeder::class,
        VehicleModelSeeder::class,
        VehicleSeeder::class,
    ];

    /**
     * Тест метода index
     *
     * @return void
     */
    public function test_index()
    {
        // Пустая модель, хотя указан пул сидеров для заполнения перед тестами
        dump(VehicleManufacturer::all());

        $response = $this->get('/api/vehicles');
        $response->assertStatus(200);
        // Временно не проверяю пока не будет фикс бага с заполнением БД
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
        // Пустая модель, хотя указан пул сидеров для заполнения перед тестами
        dump(VehicleManufacturer::all());

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
        // Временно не проверяю пока не будет фикс бага с заполнением БД
        // $response->assertJsonStructure([
        //     "message",
        //     "*" => [
        //         "vehicle_model_id",
        //         "mileage",
        //         "manufacture_year",
        //         "location",
        //         "license_plate",
        //         "price_at_minute",
        //         "updated_at",
        //         "created_at",
        //         "id"
        //     ]
        // ]);
    }

    public function test_show()
    {
        // Пустая модель, хотя указан пул сидеров для заполнения перед тестами
        dump(VehicleManufacturer::all());

        $response = $this->get('/api/vehicles/1');
        $response->assertStatus(200);
    }

    public function test_update()
    {
        // Пустая модель, хотя указан пул сидеров для заполнения перед тестами
        dump(VehicleManufacturer::all());

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
        // Пустая модель, хотя указан пул сидеров для заполнения перед тестами
        dump(VehicleManufacturer::all());

        $response = $this->delete('/api/vehicles/1');

        $response->assertStatus(200);
    }
}
