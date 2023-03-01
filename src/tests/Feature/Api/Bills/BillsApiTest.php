<?php

namespace Tests\Feature\Api\Bills;

use App\Enums\Bill\BillStatus;
use App\Models\Bill;
use Database\Seeders\BillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\ApiTest;
use Tests\TestCase;

class BillsApiTest extends ApiTest
{
    // use RefreshDatabase;

    // protected function setUp() : void
    // {
    //     parent::setUp();

    //     // сидеры для второго класса
    //     $this->seed(BillSeeder::class);
    // }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_change_bill_status()
    {
        $status = BillStatus::getRandomValue();
        // dump($status);
        $billId = Bill::all()->whereNotIn('status', $status)->random()->id;
        // dump($billId);

        $response = $this->json("POST", "/api/bills/$billId/set/status", ['status' => $status]);

        $response->assertStatus(200);
    }
}
