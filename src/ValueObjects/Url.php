<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Url extends ValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = trim($value);

        if (! filter_var($normalized, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL: ' . $normalized);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function from(mixed $value): static
    {
        return new static((string) $value);
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self
            && $other->value === $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}