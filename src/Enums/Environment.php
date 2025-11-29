<?php

namespace BeFuture\CoreShared\Enums;

enum Environment: string
{
    case Local = 'local';
    case Staging = 'staging';
    case Production = 'production';

    public function isLocal(): bool
    {
        return $this === self::Local;
    }

    public function isProduction(): bool
    {
        return $this === self::Production;
    }

    public static function fromAppEnv(?string $env): self
    {
        return match ($env) {
            'local' => self::Local,
            'staging' => self::Staging,
            'production', 'prod' => self::Production,
            default => self::Local,
        };
    }
}
