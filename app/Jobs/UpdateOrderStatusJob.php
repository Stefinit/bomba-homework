<?php

namespace App\Jobs;

use App\Events\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class UpdateOrderStatusJob implements ShouldQueue
{
    use Queueable;

    public function handle()
    {
        $orders = Order::whereIn('status', [Order::PENDING, Order::SHIPPED])->get();

        event(new OrderStatusUpdated($orders[0], 'pending'));

//        foreach ($orders as $order) {
//            $response = Http::get('https://external-api.com/status', [
//                'order_number' => $order->order_number,
//            ]);
//
//            if ($response->ok()) {
//                $data = $response->json();
//
//                if (isset($data['status']) && $data['status'] !== $order->status) {
//                    $oldStatus = $order->status;
//                    $order->status = $data['status'];
//                    $order->save();
//
//                    event(new OrderStatusUpdated($order, $oldStatus));
//                }
//            }
//        }
    }
}
