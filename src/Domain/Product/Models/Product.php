<?php

namespace Domain\Product\Models;
use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    function orders()
    {
        return $this->hasMany(Order::class);
    }




}
