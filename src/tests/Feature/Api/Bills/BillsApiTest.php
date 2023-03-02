<?php

namespace Tests\Feature\Api\Bills;

use App\Enums\Bill\BillStatus;
use App\Models\Bill;
use Database\Seeders\BillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\ApiTest;
use Tests\TestCase;

class BillsApiTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = BillSeeder::class;
    // protected $seed = true;

    /**
     * Проверка изменения статуса счета
     *
     * @return void
     */
    public function test_change_bill_status()
    {
        // Модели существуют. БД заполняется корректно.
        dump(Bill::all());
        $status = BillStatus::getRandomValue();
        $billId = Bill::all()->whereNotIn('status', $status)->random()->id;
        dump($billId);

        $response = $this->json("POST", "/api/bills/$billId/set/status", ['status' => $status]);

        $response->assertStatus(200);
    }
}
