<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(10)
            ->create()
            ->each(function ($order) {
                OrderItem::factory()
                    ->count(rand(3, 5))
                    ->create(['order_id' => $order->id]);
            });
    }
}
