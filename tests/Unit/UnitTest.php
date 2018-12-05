<?php

namespace Exolnet\Log\Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;

abstract class UnitTest extends TestCase
{
    public function tearDown()
    {
        $this->addToAssertionCount(
            Mockery::getContainer()->mockery_getExpectationCount()
        );

        Mockery::close();
    }
}
