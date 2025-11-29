<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Tests\Unit;

use BeFuture\CoreShared\DTOs\DataTransferObject;
use BeFuture\CoreShared\Tests\TestCase;

class DataTransferObjectTest extends TestCase
{
    public function test_from_array_and_to_array(): void
    {
        $dto = UserDTOStub::fromArray([
            'id'    => '123',
            'email' => 'test@example.com',
            'name'  => 'John Doe',
        ]);

        $this->assertSame('123', $dto->id);
        $this->assertSame('test@example.com', $dto->email);
        $this->assertSame('John Doe', $dto->name);

        $this->assertSame([
            'id'    => '123',
            'email' => 'test@example.com',
            'name'  => 'John Doe',
        ], $dto->toArray());
    }

    public function test_missing_fields_are_left_null(): void
    {
        $dto = UserDTOStub::fromArray([
            'id'    => '456',
            'email' => 'user@example.com',
        ]);

        $this->assertSame('456', $dto->id);
        $this->assertSame('user@example.com', $dto->email);
        $this->assertNull($dto->name);
    }
}

/**
 * Simple DTO stub used only for tests.
 */
class UserDTOStub extends DataTransferObject
{
    public string $id;
    public string $email;
    public ?string $name = null;
}