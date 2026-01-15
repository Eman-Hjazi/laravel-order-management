<?php

namespace Domain\Order\Repositories;

use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface OrderRepositoryInterface
 *
 * This interface defines the contract for Order persistence logic.
 * In Domain-Driven Design (DDD), the Repository serves as an abstraction layer
 * that allows the Domain Layer to remain independent of the specific database
 * technology (e.g., MySQL, MongoDB) or ORM (Eloquent) .
 */
interface OrderRepositoryInterface
{
    /**
     * Persist the given Order entity into the data store.
     *
     * @param Order $order The Order entity to be saved.
     * @return Order The saved Order instance.
     */
    public function save(Order $order): Order;

    /**
     * Retrieve all Order entities from the data store.
     *
     * @return Collection<int, Order> A collection of all Order entities.
     */
    public function all(): Collection;

    /**
     * Find an Order entity by its unique primary identifier.
     *
     * @param int $id The unique ID of the order.
     * @return Order|null The found Order entity, or null if not found.
     */
    public function find(int $id): ?Order;

    /**
     * Delete the given Order entity from the data store.
     *
     * @param Order $order The Order entity to be removed.
     * @return void
     */
    public function delete(Order $order): void;
}
