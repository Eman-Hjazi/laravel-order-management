<?php

namespace App\Mail;

use Domain\Order\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
            ->markdown('emails.orders.confirmation')
            ->with([
                'order' => $this->order,
                'user' => $this->order->user,
                'product' => $this->order->product,
            ]);
    }
}
