<?php

namespace Pactores\Actor;

use PHPUnit\Framework\TestCase;

class ActorIdTest extends TestCase
{
    /** @test */
    public function it_can_be_compared()
    {
        $actorId = new ActorId(42);
        $sameActorId = new ActorId(42);
        $otherActorId = new ActorId(13);

        $this->assertEquals($actorId, $sameActorId);
        $this->assertNotEquals($actorId, $otherActorId);
    }
}
