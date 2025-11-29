<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Helpers;

final class ArrayHelper
{
    private function __construct()
    {
    }

    public static function get(array $array, string $key, mixed $default = null): mixed
    {
        if ($key === '') {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        $segments = explode('.', $key);

        foreach ($segments as $segment) {
            if (! is_array($array) || ! array_key_exists($segment, $array)) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    public static function set(array &$array, string $key, mixed $value): void
    {
        if ($key === '') {
            return;
        }

        $segments = explode('.', $key);

        while (count($segments) > 1) {
            $segment = array_shift($segments);

            if (! isset($array[$segment]) || ! is_array($array[$segment])) {
                $array[$segment] = [];
            }

            $array = &$array[$segment];
        }

        $array[array_shift($segments)] = $value;
    }

    public static function flatten(array $array, string $prefix = ''): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $fullKey = $prefix === '' ? (string) $key : $prefix . '.' . $key;

            if (is_array($value)) {
                $result += self::flatten($value, $fullKey);
            } else {
                $result[$fullKey] = $value;
            }
        }

        return $result;
    }

    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    public static function except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }
}