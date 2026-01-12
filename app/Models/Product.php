<?php

namespace App\Models;

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

    function calculateDiscountedPrice($discountPercentage)
    {
        $discountAmount = ($this->price * $discountPercentage) / 100;
        return $this->price - $discountAmount;
    }


}
