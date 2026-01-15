<?php

namespace Infrastructure\Order\Repositories;

use Domain\Order\Models\Order;
use Domain\Order\Repositories\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentOrderRepository
 * This class is the concrete implementation of the OrderRepositoryInterface.
 * It uses Laravel's Eloquent ORM to handle data persistence and retrieval.
 * By placing this in the Infrastructure layer, we ensure that the Domain layer
 * remains decoupled from the database implementation details .
 */
class EloquentOrderRepository implements OrderRepositoryInterface
{
    /**
     * Persist the Order entity to the database.
     *
     * @param Order $order The domain entity to save.
     * @return Order The saved instance of the order.
     */
    public function save(Order $order): Order
    {
        $order->save();
        return $order;
    }

    /**
     * Retrieve all orders from the database using Eloquent.
     *
     * @return Collection<int, Order>
     */
    public function all(): Collection
    {
        return Order::all();
    }

    /**
     * Find a specific order by its primary ID.
     *
     * @param int $id The unique identifier of the order.
     * @return Order|null Returns the Order entity or null if not found.
     */
    public function find(int $id): ?Order
    {
        return Order::find($id);
    }

    /**
     * Remove an order from the database.
     *
     * @param Order $order The Order entity instance to delete.
     * @return void
     */
    public function delete(Order $order): void
    {
        $order->delete();
    }
}
