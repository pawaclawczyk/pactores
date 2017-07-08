<?php

namespace TryDo;

use PHPUnit\Framework\TestCase;
use Exception;

class TryDoTest extends TestCase
{
    /** @test */
    public function it_returns_success()
    {
        $returnsResult = function () : int {
            return 42;
        };

        $tryDo = TryDo::tryDo($returnsResult);

        $this->assertInstanceOf(Success::class, $tryDo);
    }

    /** @test */
    public function it_returns_failure()
    {
        $returnsResult = function () : int {
            throw new Exception();
        };

        $tryDo = TryDo::tryDo($returnsResult);

        $this->assertInstanceOf(Failure::class, $tryDo);
    }
}
