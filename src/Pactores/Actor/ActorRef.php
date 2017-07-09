<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Dispatcher;
use Pactores\Message;

final class ActorRef
{
    /** @var Props */
    private $actor;

    /** @var Dispatcher */
    private $dispatcher;

    /**
     * @param Props $actor
     * @param Dispatcher $dispatcher
     */
    public function __construct(Props $actor, Dispatcher $dispatcher)
    {
        $this->actor = $actor;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Message $message
     */
    public function tell(Message $message)
    {
        $this->dispatcher->dispatch($message, $this->actor);
    }
}
