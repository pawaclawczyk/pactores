<?php

namespace Pactores\Actor;

use PHPUnit\Framework\TestCase;

class PropertiesTest extends TestCase
{
    /** @test */
    public function it_holds_actor_class()
    {
        $properties = new Properties(ExampleActor::class);

        $this->assertEquals(ExampleActor::class, $properties->actorClass());
    }

    /** @test */
    public function it_holds_actor_constructor_arguments()
    {
        $properties = new Properties(ExampleActor::class, [42]);

        $this->assertEquals([42], $properties->constructorArguments());
    }
}
