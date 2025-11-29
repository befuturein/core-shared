<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use JsonSerializable;
use Stringable;

abstract class ValueObject implements JsonSerializable, Stringable
{
    /**
     * Quick factory for simple value objects.
     */
    public static function from(mixed $value): static
    {
        return new static($value);
    }

    /**
     * Compare two value objects by value, not by reference.
     */
    abstract public function equals(ValueObject $other): bool;

    /**
     * String representation – mostly for debugging / logging.
     */
    abstract public function __toString(): string;

    /**
     * Default json serialization uses string form.
     */
    public function jsonSerialize(): mixed
    {
        return (string) $this;
    }
}