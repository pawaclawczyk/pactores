<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\ActorRef;
use Pactores\Actor\Mailbox;
use Pactores\Actor\Properties;
use Pactores\Executor\Executor;

final class Dispatcher
{
    /** @var Mailbox[] */
    private $mailboxes = [];

    /** @var Executor */
    private $executor;

    /**
     * @param Executor $executor
     */
    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * @todo test case with not existing actor
     * @todo move creation of actor in other place
     */

    /**
     * @param ActorRef $actorRef
     * @return Mailbox
     */
    public function mailboxFor(ActorRef $actorRef): Mailbox
    {
        list($actorClass, $arguments) = $actorRef->props()->constructor();

        if (!isset($this->mailboxes[$actorClass])) {
            $actor = $actorClass::instantiate($actorRef, $arguments);

            $this->mailboxes[$actorClass] = new Mailbox($actor);
        }

        return $this->mailboxes[$actorClass];
    }

    /**
     * @param Message $message
     * @param ActorRef $recipient
     * @param ActorRef $sender
     */
    public function dispatch(Message $message, ActorRef $recipient, ActorRef $sender = null)
    {
        $mailbox = $this->mailboxFor($recipient);
        $mailbox->enqueue(new Envelope($message, $recipient, $sender));

        $this->executor->execute($mailbox);
    }
}
