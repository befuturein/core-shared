<?php

namespace BeFuture\CoreShared\Support;

use Illuminate\Contracts\Auth\Authenticatable;

class Context
{
    public function user(): ?Authenticatable
    {
        return auth()->user();
    }

    public function locale(): string
    {
        return app()->getLocale();
    }

    public function requestIp(): ?string
    {
        return request()?->ip();
    }
}
