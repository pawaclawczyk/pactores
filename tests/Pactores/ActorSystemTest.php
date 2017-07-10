<?php

namespace Pactores;

use Pactores\Actor\ActorRef;
use Pactores\Actor\ExampleActor;
use Pactores\Actor\Properties;
use Pactores\Executor\Executor;
use PHPUnit\Framework\TestCase;

class ActorSystemTest extends TestCase
{
    /** @var ActorSystem */
    private $actorSystem;

    /** @test */
    public function it_returns_actor_ref()
    {
        $actorRef = $this->actorSystem->actorOf(new Properties(ExampleActor::class));

        $this->assertInstanceOf(ActorRef::class, $actorRef);
    }

    /** @test */
    public function it_throws_exception_when_actor_cannot_be_created()
    {
        $this->markTestSkipped('Not implemented yet.');
    }

    /** @test */
    public function it_generates_different_actor_refs()
    {
        $this->markTestSkipped('Not implemented yet.');
    }

    /** @test */
    public function it_shutdowns()
    {
        $this->markTestSkipped('Not yet refactored.');

        $this->assertTrue($this->actorSystem->shutdown());
    }

    protected function setUp()
    {
        parent::setUp();

        $dispatcher = $this->prophesize(Dispatcher::class);
        $executor = $this->prophesize(Executor::class);

        $this->actorSystem = new ActorSystem($dispatcher->reveal(), $executor->reveal());
    }

    protected function tearDown()
    {
        unset($this->actorSystem);

        parent::tearDown();
    }
}
