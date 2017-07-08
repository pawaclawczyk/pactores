<?php

namespace Option;

use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    /** @test */
    public function it_creates_none()
    {
        $none = Option::None();

        $this->assertInstanceOf(None::class, $none);
    }

    /** @test */
    public function it_creates_singleton_none_object()
    {
        $this->assertEquals(
            spl_object_hash(Option::None()),
            spl_object_hash(Option::None())
        );
    }
}
