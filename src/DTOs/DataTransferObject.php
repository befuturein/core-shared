<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\DTOs;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject implements JsonSerializable
{
    /**
     * Hydrate DTO from an associative array using public properties.
     */
    public static function fromArray(array $data): static
    {
        $reflection = new ReflectionClass(static::class);
        $instance   = $reflection->newInstanceWithoutConstructor();

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $name = $property->getName();

            if (array_key_exists($name, $data)) {
                $property->setValue($instance, $data[$name]);
            }
        }

        if ($constructor = $reflection->getConstructor()) {
            // If constructor exists, we still allow initializing defaults
            $constructor->invoke($instance);
        }

        return $instance;
    }

    /**
     * Export all public properties to array.
     */
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $result     = [];

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $name  = $property->getName();
            $value = $property->getValue($this);

            $result[$name] = $this->normalizeValue($value);
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    protected function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof JsonSerializable) {
            return $value->jsonSerialize();
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format(DATE_ATOM);
        }

        if (is_array($value)) {
            return array_map(fn ($v) => $this->normalizeValue($v), $value);
        }

        return $value;
    }
}