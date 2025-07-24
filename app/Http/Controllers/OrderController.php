<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {
    }

    public function all(): Collection
    {
        return $this->orderService->all();
    }

    public function store(OrderCreateRequest $request): ?Order
    {
        return $this->orderService->store($request->validated());
    }

    public function show(Order $order): Order
    {
        return $this->orderService->show($order);
    }
}
