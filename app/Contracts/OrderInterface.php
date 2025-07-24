<?php

namespace App\Contracts;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderInterface
{
    public function all(): Collection;

    public function store(array $data): ?Order;

    public function show(Order $order): Order;

}
