<?php

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Locale extends ValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = str_replace('-', '_', strtolower(trim($value)));

        if ($normalized === '') {
            throw new InvalidArgumentException('Locale cannot be empty.');
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
