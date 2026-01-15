<?php

namespace Domain\Order\DataTransferObjects;

use App\Http\Requests\CreateOrderRequest;

/**
 * Class OrderData
 */
class OrderData
{
    public function __construct(
        public int $userId,
        public int $productId,
        public int $quantity
    ) {}

    /**
     * Static Factory Method
     *
     * We create this method manually to transform the Laravel Request object
     * into a structured Domain DTO. This keeps the Controller clean.
     *
     * @param CreateOrderRequest $request
     * @return self
     */
    public static function fromRequest(CreateOrderRequest $request): self
    {
        // We use $request->validated() to ensure we only map safe, validated data.
        return new self(
            userId: (int) $request->validated('user_id'), // Automatically get the logged-in user
            productId: (int) $request->validated('product_id'),
            quantity: (int) $request->validated('quantity'),
        );
    }
}
