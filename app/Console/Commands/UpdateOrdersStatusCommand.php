<?php

namespace App\Console\Commands;

use App\Jobs\UpdateOrderStatusJob;
use Illuminate\Console\Command;

class UpdateOrdersStatusCommand extends Command
{
    protected $signature = 'orders:update-status';

    protected $description = 'Update order statuses from external API';

    public function handle()
    {
        dispatch(new UpdateOrderStatusJob());

        $this->info('Order status update job dispatched');
    }
}
