<?php

namespace App\Jobs;

use App\Events\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatusJob implements ShouldQueue
{
    use Queueable;

    public function handle()
    {
        $orders = Order::whereIn('status', [Order::PENDING, Order::SHIPPED])->get();

        foreach ($orders as $order) {

            $response = Http::get('http://127.0.0.1:8001/api/external-api/status/' . $order->id);

            if ($response->ok()) {
                $data = $response->json();

                if (isset($data['status']) && $data['status'] !== $order->status) {
                    $oldStatus = $order->status;
                    $order->status = $data['status'];
                    $order->save();

                    event(new OrderStatusUpdated($order, $oldStatus));
                }
            } else {
                Log::error('Failed to fetch status for order ID ' . $order->id . '. HTTP status: ' . $response->status());
            }
        }
    }
}
