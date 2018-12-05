<?php namespace Exolnet\Log;

use Exolnet\Log\Processor\LaravelProcessor;
use Gelf\Publisher;
use Gelf\Transport\UdpTransport;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Log\Writer as LaravelLogWriter;
use Monolog\Handler\GelfHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;

class LogExceptionsHandler
{
    /**
     * @var \Illuminate\Contracts\Logging\Log
     */
    protected $log;

    /**
     * @var \Exolnet\Log\Processor\LaravelProcessor
     */
    protected $laravelProcessor;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @param \Illuminate\Contracts\Logging\Log $log
     * @param \Exolnet\Log\Processor\LaravelProcessor $laravelProcessor
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Log $log, LaravelProcessor $laravelProcessor, Config $config)
    {
        $this->log = $log;
        $this->laravelProcessor = $laravelProcessor;
        $this->config = $config;
    }

    public function setupHandler()
    {
        if (! $this->isConfigured()) {
            return;
        }

        $this->getMonolog()
            ->pushHandler($this->makeMonologHandler())
            ->pushProcessor(new IntrospectionProcessor())
            ->pushProcessor(new WebProcessor())
            ->pushProcessor(new MemoryUsageProcessor())
            ->pushProcessor(new MemoryPeakUsageProcessor())
            ->pushProcessor($this->laravelProcessor);
    }

    /**
     * @return \Monolog\Logger|null
     */
    public function getMonolog()
    {
        if (! $this->log instanceof LaravelLogWriter) {
            return null;
        }

        return $this->log->getMonolog();
    }

    /**
     * @return string|null
     */
    public function getMonologHost()
    {
        return $this->config->get('log.host');
    }

    /**
     * @return int
     */
    public function getMonologPort()
    {
        return $this->config->get('log.port');
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return $this->getMonologHost() && $this->getMonolog();
    }

    /**
     * @return \Monolog\Handler\GelfHandler
     */
    protected function makeMonologHandler()
    {
        $transport = new UdpTransport($this->getMonologHost(), $this->getMonologPort());
        $publisher = new Publisher($transport);

        return new GelfHandler($publisher, Logger::ERROR);
    }
}
