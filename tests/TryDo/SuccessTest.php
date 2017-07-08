<?php

namespace TryDo;

use PHPUnit\Framework\TestCase;
use Exception;

class SuccessTest extends TestCase
{
    /** @test */
    public function it_maps_with_successful_function()
    {
        $successfulFunction = function () {
            return 42;
        };

        $success = new Success(7);

        $this->assertInstanceOf(Success::class, $success->map($successfulFunction));
    }

    /** @test */
    public function it_maps_with_failure_function()
    {
        $failureFunction = function () {
            throw new Exception();
        };

        $success = new Success(new Exception());

        $this->assertInstanceOf(Failure::class, $success->map($failureFunction));
    }
}
