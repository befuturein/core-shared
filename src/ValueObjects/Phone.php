<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Phone extends ValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = preg_replace('/\s+/', '', $value);

        if (! preg_match('/^\+?[0-9]{7,20}$/', $normalized)) {
            throw new InvalidArgumentException('Invalid phone number: ' . $value);
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