<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    // public function test_api()
    // {
    //     $response = $this->get('/api');

    //     $response->assertStatus(404);
    // }

    // public function test_api_documentation()
    // {
    //     $response = $this->get('/api/documentation');

    //     $response->assertStatus(200);
    // }
}
