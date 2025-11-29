<?php

use BeFuture\CoreShared\Support\Context;

if (! function_exists('befuture_context')) {
    function befuture_context(): Context
    {
        return app(Context::class);
    }
}
