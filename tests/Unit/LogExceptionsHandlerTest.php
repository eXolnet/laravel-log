<?php

namespace Exolnet\Log\Tests\Unit;

use Exolnet\Log\LogExceptionsHandler;
use Exolnet\Log\Processor\LaravelProcessor;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Log\Writer as LaravelLogWriter;
use Mockery as m;
use Monolog\Logger;

class LogExceptionsHandlerTest extends UnitTest
{
    /**
     * @var \Exolnet\Log\LogExceptionsHandler::__construct
     */
    protected $handler;

    /**
     * @var \Mockery\MockInterface|\Illuminate\Log\Writer
     */
    protected $log;

    /**
     * @var \Mockery\MockInterface|\Exolnet\Log\Processor\LaravelProcessor
     */
    protected $laravelProcessor;

    /**
     * @var \Mockery\MockInterface|\Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @var \Mockery\MockInterface|\Monolog\Logger
     */
    protected $monolog;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->log = m::mock(LaravelLogWriter::class);
        $this->laravelProcessor = m::mock(LaravelProcessor::class);
        $this->config = m::mock(Config::class);
        $this->monolog = m::mock(Logger::class);

        $this->handler = new LogExceptionsHandler($this->log, $this->laravelProcessor, $this->config);
    }

    /**
     * @return void
     */
    public function testWithoutMonologHost()
    {
        $this->config->shouldReceive('get')->with('log.host')->andReturn(null);

        $this->handler->setupHandler();
    }

    /**
     * @return void
     */
    public function testWithoutMonolog()
    {
        $this->config->shouldReceive('get')->with('log.host')->andReturn('localhost');
        $this->log->shouldReceive('getMonolog')->andReturn(null);

        $this->handler->setupHandler();
    }

    public function testSetupHandler()
    {
        $this->config->shouldReceive('get')->with('log.host')->andReturn('localhost');
        $this->config->shouldReceive('get')->with('log.port')->andReturn(12201);

        $this->log->shouldReceive('getMonolog')->andReturn($this->monolog);

        $this->monolog->shouldReceive('pushHandler')->once()->andReturnSelf();
        $this->monolog->shouldReceive('pushProcessor')->times(5)->andReturnSelf();

        $this->handler->setupHandler();
    }
}
