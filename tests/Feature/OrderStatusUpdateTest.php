<?php

namespace Tests\Feature;

use App\Events\OrderStatusUpdated;
use App\Jobs\UpdateOrderStatusJob;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OrderStatusUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_status_is_updated_and_event_fired()
    {
        Event::fake();
        Http::fake([
            'http://127.0.0.1:8001/api/external-api/status/1' => Http::response([
                'order_number' => 'ORDER999',
                'status' => 'shipped',
            ], 200),
        ]);

        $order = Order::create([
            'order_number' => '55555',
            'status' => 'pending',
            'total_amount' => 100.0,
        ]);

        (new UpdateOrderStatusJob())->handle();

        $order->refresh();

        $this->assertEquals('shipped', $order->status);

        Event::assertDispatched(OrderStatusUpdated::class, function ($event) use ($order) {
            return $event->order->id === $order->id
                && $event->oldStatus === 'pending'
                && $event->order->status === 'shipped';
        });
    }

}
