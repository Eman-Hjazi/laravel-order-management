<?php

namespace Domain\Order\Events;

use Domain\Order\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderPlaced
 *
 * This is a Domain Event. It represents a significant occurrence within the domain
 * that other parts of the system (or even other domains) might need to react to.
 *
 * In Domain-Driven Design, events help in decoupling different components, ensuring
 * that the Order domain doesn't need to know about side effects like sending emails
 * or updating analytics directly.
 */
class OrderPlaced
{
    use Dispatchable, SerializesModels;

    /**
     * The Order entity instance that was placed.
     *
     * @var Order
     */
    public Order $order;

    /**
     * Create a new event instance.
     *
     * This constructor receives the Order entity, which acts as the event payload.
     * By using SerializesModels, Laravel ensures that if the event is queued,
     * the Order model is correctly reloaded from the database when the listener runs.
     *
     * @param Order $order The Order entity that triggered this event.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
