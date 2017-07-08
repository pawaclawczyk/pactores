<?php

namespace Option;

use PHPUnit\Framework\TestCase;

class SomeTest extends TestCase
{
    /** @test */
    public function it_returns_inner_value()
    {
        $some = new Some(42);

        $this->assertEquals(42, $some->getOrElse(13));
    }
}
