<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Dispatcher;
use Pactores\Message;

final class ActorRef
{
    /** @var string */
    private $actorClass;

    /** @var Dispatcher */
    private $dispatcher;

    /**
     * @param string $actorClass
     * @param Dispatcher $dispatcher
     */
    public function __construct(string $actorClass, Dispatcher $dispatcher)
    {
        $this->actorClass = $actorClass;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Message $message
     */
    public function tell(Message $message)
    {
        $this->dispatcher->dispatch($message, $this->actorClass);
    }
}
