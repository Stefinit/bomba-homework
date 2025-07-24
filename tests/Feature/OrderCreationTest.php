<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_creation_with_items()
    {
        $payload = [
            'order_number' => '55554',
            'status' => 'pending',
            'total_amount' => 200.50,
            'items' => [
                ['product_name' => 'Item 1', 'quantity' => 2, 'price' => 50.00],
                ['product_name' => 'Item 2', 'quantity' => 1, 'price' => 100.50],
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'order_number' => '55554',
                'status' => 'pending',
                'total_amount' => 200.50,
            ]);

        $items = $response->json('data.items');
        $this->assertIsArray($items);
        $this->assertCount(2, $items);

        $this->assertDatabaseHas('orders', ['order_number' => '55554']);
        $this->assertDatabaseHas('order_items', ['product_name' => 'Item 1']);
    }



}
