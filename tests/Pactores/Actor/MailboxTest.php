<?php

namespace Pactores\Actor;

use Option\Option;
use Pactores\Message;
use PHPUnit\Framework\TestCase;
use Countable;

class MailboxTest extends TestCase
{
    const SOME_ACTOR_CLASS = 'SomeActor';

    /** @var Mailbox */
    private $mailbox;

    /** @test */
    public function it_belongs_to_actor()
    {
        $this->assertEquals(self::SOME_ACTOR_CLASS, $this->mailbox->owner());
    }

    /** @test */
    public function it_enqueues_message_and_dequeues_option_message()
    {
        $this->mailbox->enqueue(new ExampleMesssage());

        $message = $this->mailbox->dequeue();
        $this->assertInstanceOf(Option::class, $message);
        $this->assertInstanceOf(Message::class, $message->getOrElse(null));
    }

    /** @test */
    public function it_dequeues_option_none_when_empty()
    {
        $message = $this->mailbox->dequeue();

        $this->assertEquals(Option::None(), $message);
    }

    /** @test */
    public function it_is_countable()
    {
        $this->assertInstanceOf(Countable::class, $this->mailbox);
    }

    /** @test */
    public function it_counts_messages()
    {
        $this->assertCount(0, $this->mailbox);

        $this->mailbox->enqueue(new ExampleMesssage());
        $this->mailbox->enqueue(new ExampleMesssage());

        $this->assertCount(2, $this->mailbox);

        $this->mailbox->dequeue();

        $this->assertCount(1, $this->mailbox);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->mailbox = new Mailbox(self::SOME_ACTOR_CLASS);
    }

    protected function tearDown()
    {
        $this->mailbox = null;

        parent::tearDown();
    }
}
