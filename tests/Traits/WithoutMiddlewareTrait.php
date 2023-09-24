<?php

namespace Tests\Traits;

use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Routing\Middleware\ThrottleRequests;

trait WithoutMiddlewareTrait
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            Authenticate::class,
            Authorize::class,
            ThrottleRequests::class,
        ]);
    }
}
