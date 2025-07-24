<?php

namespace App\Models\Scopes;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderFilterStatusScope implements Scope
{
    protected ?string $status;

    public function __construct(?string $status)
    {
        $this->status = $status;
    }

    public function apply(Builder $builder, Model $model): void
    {
        if ($this->status && in_array($this->status, Order::STATUSES)) {
            $builder->where('status', $this->status);
        }
    }
}
