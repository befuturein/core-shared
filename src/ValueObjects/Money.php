<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Money extends ValueObject
{
    /**
     * Amount is stored in minor units (e.g. cents).
     */
    public function __construct(
        private readonly int $amount,
        private readonly string $currency
    ) {
        if ($this->amount < 0) {
            throw new InvalidArgumentException('Amount cannot be negative.');
        }

        if ($this->currency === '' || strlen($this->currency) !== 3) {
            throw new InvalidArgumentException('Currency must be a 3-letter ISO code.');
        }

        $this->currency = mb_strtoupper($this->currency);
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