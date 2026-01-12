<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Console\Events\ScheduledTaskFinished;
use Illuminate\Events\Attributes\AsEventListener;

#[AsEventListener(event: OrderPlaced::class)]
class SendOrderConfirmation
{
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;

        Mail::to($order->user->email)
            ->send(new OrderConfirmationMail($order));
    }
}
