<?php

namespace Domain\Order\Models;

use Domain\User\Models\User;
use Domain\Product\Models\Product;
use Domain\Order\ValueObjects\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * This class represents the Order Entity within the Domain Layer.
 * It is a "Rich Domain Model" that encapsulates both state and business behavior .
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property float $discount
 * @property float $total
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'total',
    ];

    /**
     * Get the product associated with the order.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who placed the order.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Apply domain business logic to calculate discounts and totals.
     *
     * This method ensures that business invariants are maintained within the Entity
     * rather than leaking into the Controller or Action layers .
     * It uses the Money Value Object to ensure precision in financial calculations .
     *
     * Business Rule: A 10% discount is applied if the quantity is 5 or more .
     *
     * @return void
     */
    public function applyDiscountAndCalculateTotal(): void
    {
        // Wrap the raw price into a Money Value Object for safe calculation
        $priceVO = new Money($this->price);

        // Apply business rule: Determine discount amount based on quantity
        $discountAmount = $this->quantity >= 5
            ? $priceVO->multiply(0.1)
            : new Money(0);

        // Calculate final total: (Price * Quantity) - Discount
        $finalTotal = $priceVO->subtract($discountAmount)->multiply($this->quantity);

        // Internalize the calculated results into the Entity's state
        $this->discount = $discountAmount->getAmount();
        $this->total = $finalTotal->getAmount();
    }
}
