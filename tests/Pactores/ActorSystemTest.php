<?php

namespace Pactores;

use Pactores\Actor\ActorRef;
use Pactores\Actor\Properties;
use PHPUnit\Framework\TestCase;

class ActorSystemTest extends TestCase
{
    /** @var ActorSystem */
    private $actorSystem;

    /** @test */
    public function it_returns_actor_ref()
    {
        $actorRef = $this->actorSystem->actorOf(new Properties('SomeActor'));

        $this->assertInstanceOf(ActorRef::class, $actorRef);
    }

    /** @test */
    public function it_shutdowns()
    {
        $this->assertTrue($this->actorSystem->shutdown());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->actorSystem = new ActorSystem();
    }

    protected function tearDown()
    {
        $this->actorSystem->shutdown();

        unset($this->actorSystem);

        parent::tearDown();
    }
}
