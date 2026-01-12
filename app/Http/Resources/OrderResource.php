<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'total' => $this->total,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'price' => $this->product->price,
            ],
        ];
    }
}
