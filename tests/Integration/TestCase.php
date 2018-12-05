<?php

namespace Exolnet\Log\Tests\Integration;

use Exolnet\Log\LogServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LogServiceProvider::class,
        ];
    }
}
