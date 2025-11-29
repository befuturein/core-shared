<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\ValueObjects;

use Carbon\CarbonImmutable;
use DateTimeInterface;
use InvalidArgumentException;

final class DateTimeValue extends ValueObject
{
    public function __construct(
        private readonly CarbonImmutable $value
    ) {
    }

    public static function fromString(string $datetime, ?string $timezone = null): self
    {
        try {
            return new self(
                new CarbonImmutable($datetime, $timezone)
            );
        } catch (\Throwable $e) {
            throw new InvalidArgumentException('Invalid datetime string: ' . $datetime, 0, $e);
        }
    }

    public static function fromDateTime(DateTimeInterface $dateTime): self
    {
        return new self(CarbonImmutable::instance($dateTime));
    }

    public function value(): CarbonImmutable
    {
        return $this->value;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self
            && $other->value->equalTo($this->value);
    }

    public function __toString(): string
    {
        return $this->value->toIso8601String();
    }
}