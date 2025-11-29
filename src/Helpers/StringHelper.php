<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Helpers;

final class StringHelper
{
    private function __construct()
    {
    }

    public static function startsWith(string $haystack, string $needle): bool
    {
        return $needle === '' || str_starts_with($haystack, $needle);
    }

    public static function endsWith(string $haystack, string $needle): bool
    {
        return $needle === '' || str_ends_with($haystack, $needle);
    }

    public static function slug(string $value, string $separator = '-'): string
    {
        $value = preg_replace('~[^\pL\d]+~u', $separator, $value);
        $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        $value = preg_replace('~[^-\w]+~', '', $value);
        $value = trim($value, $separator);
        $value = preg_replace('~-+~', $separator, $value);

        return strtolower($value) ?: 'n-a';
    }

    public static function camel(string $value): string
    {
        $value = str_replace(['-', '_'], ' ', $value);
        $value = ucwords($value);

        return lcfirst(str_replace(' ', '', $value));
    }

    public static function snake(string $value, string $delimiter = '_'): string
    {
        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value);
            $value = strtolower($value);
        }

        return $value;
    }
}