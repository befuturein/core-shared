<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

final class Email extends ValueObject
{
    public function __construct(
        private readonly string $value
    ) {
        $normalized = trim($this->value);

        if (! filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address: ' . $normalized);
        }

        $this->value = mb_strtolower($normalized);
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