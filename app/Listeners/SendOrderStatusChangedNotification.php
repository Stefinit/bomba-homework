<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Mail\OrderStatusChangedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderStatusChangedNotification
{
    use InteractsWithQueue;

    public function handle(OrderStatusUpdated $event): void
    {
         Mail::to('hincustefan1995@gmail.com')->send(new OrderStatusChangedMail($event->order));
    }
}
