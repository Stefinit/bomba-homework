<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function __construct(
        protected OrderRepository $orderRepository
    ) {
    }

    public function all(): Collection
    {
        return $this->orderRepository->all();
    }

    public function store(array $data): ?Order
    {
        return $this->orderRepository->store($data);
    }

    public function show(Order $order): Order
    {
        return $this->orderRepository->show($order);
    }
}
