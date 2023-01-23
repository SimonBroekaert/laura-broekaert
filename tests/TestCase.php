<?php

namespace Tests;

use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Clear config cache
        Artisan::call('config:clear');

        if (! app()->environment('testing')) {
            throw new Exception('Application is not in testing environment');
        }

        // Force Http::fake() to be called for all Http requests
        Http::preventStrayRequests();
    }
}
