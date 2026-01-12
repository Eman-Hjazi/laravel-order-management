<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use App\DTOs\OrderData;

class CreateOrderAction
{
    public function execute(OrderData $data): Order
    {
        $product = Product::findOrFail($data->productId);

        $discount = $data->quantity >= 5 ? $product->price * 0.1 : 0;

        $total = ($product->price - $discount) * $data->quantity;

        return Order::create([
            'user_id' => $data->userId,
            'product_id' => $product->id,
            'quantity' => $data->quantity,
            'price' => $product->price,
            'discount' => $discount,
            'total' => $total,
        ]);
    }
}
