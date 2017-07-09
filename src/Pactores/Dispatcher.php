<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\Mailbox;
use Pactores\Actor\Props;
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
     * @param Props $actor
     * @return Mailbox
     */
    public function mailboxFor(Props $actor): Mailbox
    {
        list($actorClass, $arguments) = $actor->constructor();

        if (!isset($this->mailboxes[$actorClass])) {
            $actor = new $actorClass(...$arguments);

            $this->mailboxes[$actorClass] = new Mailbox($actor);
        }

        return $this->mailboxes[$actorClass];
    }

    /**
     * @param Message $message
     * @param Props $recipient
     */
    public function dispatch(Message $message, Props $recipient)
    {
        $mailbox = $this->mailboxFor($recipient);
        $mailbox->enqueue($message);

        $this->executor->execute($mailbox);
    }
}
