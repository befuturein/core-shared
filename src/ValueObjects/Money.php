<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Money extends ValueObject
{
    private int $amount;
    private string $currency;

    public function __construct(int $amount, string $currency)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount cannot be negative.');
        }

        if ($currency === '' || strlen($currency) !== 3) {
            throw new InvalidArgumentException('Currency must be a 3-letter ISO code.');
        }

        $this->amount   = $amount;
        $this->currency = mb_strtoupper($currency);
    }

    public static function fromFloat(float $amount, string $currency, int $precision = 2): self
    {
        $multiplier = 10 ** $precision;

        return new self(
            (int) round($amount * $multiplier),
            $currency
        );
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self
            && $other->amount === $this->amount
            && $other->currency === $this->currency;
    }

    public function __toString(): string
    {
        return $this->amount . ' ' . $this->currency;
    }

    public function toFloat(int $precision = 2): float
    {
        return $this->amount / (10 ** $precision);
    }
}