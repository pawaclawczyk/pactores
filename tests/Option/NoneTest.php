<?php

namespace Option;

use PHPUnit\Framework\TestCase;

class NoneTest extends TestCase
{
    /** @test */
    public function it_returns_else_value()
    {
        $none = Option::None();

        $this->assertEquals(13, $none->getOrElse(13));
    }
}
