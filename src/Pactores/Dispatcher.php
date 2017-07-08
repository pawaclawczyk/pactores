<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\Mailbox;
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
     * @param string $actorClass
     * @return Mailbox
     */
    public function mailboxFor(string $actorClass): Mailbox
    {
        if (!isset($this->mailboxes[$actorClass])) {
            $actor = new $actorClass();
            $this->mailboxes[$actorClass] = new Mailbox($actor);
        }

        return $this->mailboxes[$actorClass];
    }

    /**
     * @param mixed $message
     * @param string $recipient
     * @return void
     */
    public function dispatch($message, string $recipient)
    {
        $mailbox = $this->mailboxFor($recipient);
        $mailbox->enqueue($message);

        $this->executor->execute($mailbox);
    }
}
