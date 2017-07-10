<?php

namespace Pactores\Actor;

use Pactores\Dispatcher;
use Pactores\Mail;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class ActorRefTest extends TestCase
{
    /** @var ObjectProphecy|Dispatcher */
    private $dispatcher;

    /** @var ActorRef */
    private $actorRef;

    /** @test */
    public function it_should_send_mail_to_dispatcher()
    {
        $mail = new Mail("A message", new ActorId(42));
        $this->dispatcher->send($mail)->shouldBeCalled();

        $this->actorRef->tell("A message");
    }

    protected function setUp()
    {
        parent::setUp();

        $this->dispatcher = $this->prophesize(Dispatcher::class);
        $this->actorRef = new ActorRef(new ActorId(42), $this->dispatcher->reveal());
    }
}
