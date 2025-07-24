<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;
use App\Models\Order;
use App\Models\Scopes\OrderFilterStatusScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderInterface
{

    public function all(): Collection
    {
        return Order::withGlobalScope('status_filter', new OrderFilterStatusScope(request('status')))
            ->with('items')
            ->get();
    }

    public function store(array $data): ?Order
    {
        try {
            $data['status'] = Order::PENDING;

            return DB::transaction(function () use ($data) {
                $order = Order::create($data);
                $order->items()->createMany($data['items']);

                return $order->load('items');
            });
        } catch (\Throwable $e) {
            Log::error('Order creation failed: ' . $e->getMessage());

            return null;
        }
    }

    public function show(Order $order): Order
    {
        return $order->load('items');
    }
}
