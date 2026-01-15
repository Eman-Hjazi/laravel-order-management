<?php

namespace Infrastructure\Order\Listeners;

use Domain\Order\Events\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Events\Attributes\AsEventListener;

/**
 * Class SendOrderConfirmation
 *
 * This is a Domain Event Listener. Its primary responsibility is to react
 * to the "OrderPlaced" event by triggering a notification process.
 *
 * In Domain-Driven Design (DDD) and Event-Driven Architecture (EDA), listeners
 * help keep the core Domain Action (CreateOrderAction) focused only on business
 * logic, while delegating secondary tasks like sending emails to specialized handlers.
 */
#[AsEventListener(event: OrderPlaced::class)]
class SendOrderConfirmation
{
    /**
     * Handle the event.
     *
     * This method extracts the Order entity from the event payload and uses
     * the Mail infrastructure to send a confirmation to the customer.
     *
     * Note: Sending mail is an infrastructure concern, but the decision to
     * notify the user is a business requirement triggered by a domain event.
     *
     * @param OrderPlaced $event The domain event instance containing the placed order.
     * @return void
     */
    public function handle(OrderPlaced $event): void
    {
        // 1. Extract the order entity from the event
        $order = $event->order;

        // 2. Delegate to Laravel's Mail service to deliver the confirmation
        // It retrieves the email directly from the User entity associated with the Order.
        Mail::to($order->user->email)
            ->send(new OrderConfirmationMail($order));
    }
}
