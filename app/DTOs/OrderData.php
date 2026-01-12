<?php

namespace App\DTOs;

class OrderData
{
    public int $userId;
    public int $productId;
    public int $quantity;

    public function __construct(array $data)
    {
        $this->userId = $data['user_id'];
        $this->productId = $data['product_id'];
        $this->quantity = $data['quantity'];
    }
}
