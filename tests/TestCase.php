<?php

namespace BeFuture\CoreShared\Tests;

use BeFuture\CoreShared\CoreSharedServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [CoreSharedServiceProvider::class];
    }
}
