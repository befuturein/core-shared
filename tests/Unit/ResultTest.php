<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Tests\Unit;

use BeFuture\CoreShared\Support\Result;
use BeFuture\CoreShared\Tests\TestCase;

class ResultTest extends TestCase
{
    public function test_success_result(): void
    {
        $result = Result::success(['foo' => 'bar'], 'ok');

        $this->assertTrue($result->isSuccess());
        $this->assertFalse($result->isFailure());
        $this->assertSame(['foo' => 'bar'], $result->data());
        $this->assertSame('ok', $result->message());
        $this->assertNull($result->code());
    }

    public function test_failure_result(): void
    {
        $result = Result::failure('error', 'E001', ['foo' => 'bar']);

        $this->assertTrue($result->isFailure());
        $this->assertFalse($result->isSuccess());
        $this->assertSame('error', $result->message());
        $this->assertSame('E001', $result->code());
        $this->assertSame(['foo' => 'bar'], $result->data());
    }

    public function test_from_boolean(): void
    {
        $success = Result::fromBoolean(true, 'ok', 'fail');
        $failure = Result::fromBoolean(false, 'ok', 'fail');

        $this->assertTrue($success->isSuccess());
        $this->assertSame('ok', $success->message());

        $this->assertTrue($failure->isFailure());
        $this->assertSame('fail', $failure->message());
    }

    public function test_json_serialize(): void
    {
        $result = Result::success(['foo' => 'bar'], 'ok');

        $this->assertSame(
            [
                'success' => true,
                'message' => 'ok',
                'code'    => null,
                'data'    => ['foo' => 'bar'],
            ],
            $result->jsonSerialize()
        );
    }
}