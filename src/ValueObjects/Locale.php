<?php

namespace BeFuture\CoreShared\ValueObjects;

use InvalidArgumentException;

class Locale
{
    public string $value;

    public function __construct(string $value)
    {
        $normalized = str_replace('_', '-', strtolower($value));

        if (! preg_match('/^[a-z]{2}(-[A-Z]{2})?$/', $normalized)) {
            throw new InvalidArgumentException("Invalid locale: {$value}");
        }

        $this->value = $normalized;
    }

    public static function from(?string $locale): self
    {
        return new self($locale ?? app()->getLocale());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
