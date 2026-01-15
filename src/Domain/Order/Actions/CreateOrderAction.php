<?php

namespace Domain\Order\Actions;

use Domain\Order\Models\Order;
use Domain\Product\Models\Product;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Repositories\OrderRepositoryInterface;

/**
 * Class CreateOrderAction
 *
 * This action handles the "Create Order" user story.
 * It serves as an orchestrator that coordinates between DTOs, Entities, and Repositories .
 */
class CreateOrderAction
{
    /**
     * CreateOrderAction constructor.
     *
     * @param OrderRepositoryInterface $orderRepository The repository interface to handle persistence .
     */
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Execute the order creation process.
     *
     * This method transforms the structured DTO into a Domain Entity,
     * triggers internal business logic, and saves the result .
     *
     * @param OrderData $data Type-safe data transfer object containing order details.
     * @return Order The fully processed and persisted Order Entity .
     */
    public function execute(OrderData $data): Order
    {
        // 1. Fetch the product details (Technical detail needed for coordination)
        $product = Product::findOrFail($data->productId);

        // 2. Initialize the Domain Entity with raw attributes.
        // We only pass basic data; the Entity itself will handle the rules .
        $order = new Order([
            'user_id'    => $data->userId,
            'product_id' => $product->id,
            'quantity'   => $data->quantity,
            'price'      => $product->price, // Pass the raw price to be handled by the Entity
        ]);

        // 3. Delegate business logic to the Rich Entity.
        // The Entity is responsible for its own invariants and calculations.
        $order->applyDiscountAndCalculateTotal();

        // 4. Persist the Entity through the Repository abstraction.
        // This ensures the Domain logic remains independent of the database technology .
        return $this->orderRepository->save($order);
    }
}
