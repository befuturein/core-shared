<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Helpers;

use Carbon\CarbonImmutable;
use DateTimeInterface;

final class DateHelper
{
    private function __construct()
    {
    }

    public static function now(?string $timezone = null): CarbonImmutable
    {
        return CarbonImmutable::now($timezone);
    }

    public static function parse(string $datetime, ?string $timezone = null): CarbonImmutable
    {
        return new CarbonImmutable($datetime, $timezone);
    }

    public static function fromDateTime(DateTimeInterface $dateTime): CarbonImmutable
    {
        return CarbonImmutable::instance($dateTime);
    }

    public static function startOfDay(CarbonImmutable $date): CarbonImmutable
    {
        return $date->startOfDay();
    }

    public static function endOfDay(CarbonImmutable $date): CarbonImmutable
    {
        return $date->endOfDay();
    }
}