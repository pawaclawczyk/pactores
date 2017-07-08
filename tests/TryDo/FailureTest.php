<?php

namespace TryDo;

use PHPUnit\Framework\TestCase;
use Exception;

class FailureTest extends TestCase
{
    /** @test */
    public function it_maps_with_successful_function()
    {
        $successfulFunction = function () {
            return 42;
        };

        $failure = new Failure(new Exception());

        $this->assertInstanceOf(Failure::class, $failure->map($successfulFunction));
    }

    /** @test */
    public function it_maps_with_failure_function()
    {
        $failureFunction = function () {
            throw new Exception();
        };

        $failure = new Failure(new Exception());

        $this->assertInstanceOf(Failure::class, $failure->map($failureFunction));
    }
}
