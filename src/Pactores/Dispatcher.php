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
     * @param string $actor
     * @return Mailbox
     */
    public function mailboxFor(string $actor): Mailbox
    {
        if (!isset($this->mailboxes[$actor])) {
            $this->mailboxes[$actor] = new Mailbox($actor);
        }

        return $this->mailboxes[$actor];
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
