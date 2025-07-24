<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_creation_with_items()
    {
        $payload = [
            'order_number' => '55555',
            'total_amount' => 200.50,
            'items' => [
                ['product_name' => 'Item 1', 'quantity' => 2, 'price' => 50.00],
                ['product_name' => 'Item 2', 'quantity' => 1, 'price' => 100.50],
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'order_number' => '55555',
                'status' => 'pending',
                'total_amount' => 200.50,
            ])
            ->assertJsonCount(2, 'items');

        $this->assertDatabaseHas('orders', ['order_number' => '55555']);
        $this->assertDatabaseHas('order_items', ['product_name' => 'Item 1']);
    }
}
