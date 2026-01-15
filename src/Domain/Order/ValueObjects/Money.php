<?php

namespace Domain\Order\ValueObjects;

use InvalidArgumentException;

/**
 * Class Money
 *
 * This is a Value Object representing a monetary amount and its currency.
 * In Domain-Driven Design, Value Objects are immutable and defined by their attributes
 * rather than a unique identity .
 */
final class Money
{
    /** @var float The numeric value of the money instance. */
    private float $amount;

    /** @var string The ISO currency code (e.g., USD, EUR). */
    private string $currency;

    /**
     * Money constructor.
     *
     * Ensures that the monetary amount is valid and normalized upon creation.
     * Value Objects must be valid from the moment they are instantiated.
     *
     * @param float $amount The amount, must be non-negative.
     * @param string $currency The currency code, defaults to USD.
     * @throws InvalidArgumentException if the amount is negative.
     */
    public function __construct(float $amount, string $currency = 'USD')
    {
        if ($amount < 0) {
            throw new InvalidArgumentException("Amount cannot be negative.");
        }

        // Round to 2 decimal points to ensure financial calculation precision .
        $this->amount = round($amount, 2);
        $this->currency = strtoupper($currency);
    }

    /**
     * Return the raw numeric amount.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Return the normalized currency code.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Add another Money instance to this one.
     * Since Value Objects are immutable, this returns a new instance.
     *
     * @param Money $other
     * @return Money
     * @throws InvalidArgumentException if currencies do not match.
     */
    public function add(Money $other): Money
    {
        $this->assertSameCurrency($other);
        return new Money($this->amount + $other->amount, $this->currency);
    }

    /**
     * Subtract another Money instance from this one.
     *
     * @param Money $other
     * @return Money
     * @throws InvalidArgumentException if resulting amount is negative or currencies mismatch.
     */
    public function subtract(Money $other): Money
    {
        $this->assertSameCurrency($other);
        $result = $this->amount - $other->amount;

        if ($result < 0) {
            throw new InvalidArgumentException("Resulting amount cannot be negative.");
        }

        return new Money($result, $this->currency);
    }

    /**
     * Multiply the current amount by a factor (e.g., for calculating quantity or tax).
     *
     * @param float $factor
     * @return Money
     * @throws InvalidArgumentException if factor is negative.
     */
    public function multiply(float $factor): Money
    {
        if ($factor < 0) {
            throw new InvalidArgumentException("Factor cannot be negative.");
        }

        return new Money($this->amount * $factor, $this->currency);
    }

    /**
     * Determine if two Money objects are equal.
     * Value Objects are equal if all their properties are identical .
     *
     * @param Money $other
     * @return bool
     */
    public function equals(Money $other): bool
    {
        return $this->currency === $other->currency && $this->amount === $other->amount;
    }

    /**
     * Convert the money object to a human-readable string.
     * Useful for JSON serialization or logging purposes .
     *
     * @return string
     */
    public function __toString(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    /**
     * Guard method to ensure operations only occur between identical currencies.
     *
     * @param Money $other
     * @return void
     * @throws InvalidArgumentException
     */
    private function assertSameCurrency(Money $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException("Currencies must match.");
        }
    }
}
