<?php

namespace Exolnet\Log\Processor;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Foundation\Application;

class LaravelProcessor
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Application $app, Config $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function __invoke(array $record)
    {
        $record['extra']['app'] = $this->config->get('log.app');
        $record['extra']['env'] = $this->app->environment();

        return $record;
    }
}
