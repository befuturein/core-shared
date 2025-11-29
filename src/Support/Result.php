<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Support;

use JsonSerializable;

final class Result implements JsonSerializable
{
    private function __construct(
        private readonly bool $success,
        private readonly mixed $data = null,
        private readonly ?string $message = null,
        private readonly ?string $code = null
    ) {
    }

    public static function success(mixed $data = null, ?string $message = null): self
    {
        return new self(true, $data, $message);
    }

    public static function failure(?string $message = null, ?string $code = null, mixed $data = null): self
    {
        return new self(false, $data, $message, $code);
    }

    public static function fromBoolean(bool $condition, ?string $successMessage = null, ?string $failureMessage = null): self
    {
        return $condition
            ? self::success(null, $successMessage)
            : self::failure($failureMessage);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isFailure(): bool
    {
        return ! $this->success;
    }

    public function data(): mixed
    {
        return $this->data;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'code'    => $this->code,
            'data'    => $this->data,
        ];
    }
}