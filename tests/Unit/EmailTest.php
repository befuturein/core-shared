<?php

declare(strict_types=1);

namespace BeFuture\CoreShared\Tests\Unit;

use BeFuture\CoreShared\Tests\TestCase;
use BeFuture\CoreShared\ValueObjects\Email;
use InvalidArgumentException;

class EmailTest extends TestCase
{
    public function test_it_creates_email_from_valid_string(): void
    {
        $email = Email::from('Test@Example.com');

        $this->assertSame('test@example.com', $email->value());
        $this->assertSame('test@example.com', (string) $email);
    }

    public function test_it_throws_exception_for_invalid_email(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Email::from('not-an-email');
    }

    public function test_equals_compares_value_objects(): void
    {
        $email1 = Email::from('a@example.com');
        $email2 = Email::from('a@example.com');
        $email3 = Email::from('b@example.com');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }
}