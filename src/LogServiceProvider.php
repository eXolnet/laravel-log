<?php

namespace Exolnet\Log;

use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__.'/../config/log.php' => config_path('log.php')
                ],
                'config'
            );
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/log.php', 'log');

        if ($this->app->environment() === 'testing') {
            return;
        }

        $this->app
            ->make(LogExceptionsHandler::class)
            ->setupHandler();
    }
}
