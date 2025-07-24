<?php

namespace Tests\Feature;

use App\Jobs\UpdateOrderStatusJob;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExternalApiErrorHandlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_external_api_error_is_handled_gracefully()
    {
        Http::fake([
            'http://127.0.0.1:8001/api/external-api/status/1' => Http::response(null, 500),
        ]);

        Log::shouldReceive('error')->once();

        $order = Order::create([
            'order_number' => '4444',
            'status' => 'pending',
            'total_amount' => 50.0,
        ]);

        (new UpdateOrderStatusJob())->handle();

        $order->refresh();

        $this->assertEquals('pending', $order->status);
    }
}
