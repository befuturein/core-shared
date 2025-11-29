<?php

namespace BeFuture\CoreShared\Tests\Unit;

use BeFuture\CoreShared\Enums\Environment;
use BeFuture\CoreShared\Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_environment_enum(): void
    {
        config(['app.env' => 'production']);
        $env = Environment::fromAppEnv(config('app.env'));
        $this->assertTrue($env->isProduction());
    }
}
