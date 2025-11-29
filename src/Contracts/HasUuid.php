<?php

namespace BeFuture\CoreShared\Contracts;

interface HasUuid
{
    public function getUuidColumn(): string;

    public function getUuid(): ?string;
}
