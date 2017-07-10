<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Dispatcher;
use Pactores\Message;

class ActorRef
{
    /** @var Properties */
    protected $actor;

    /** @var Dispatcher */
    protected $dispatcher;

    /**
     * @param Properties $actor
     * @param Dispatcher $dispatcher
     */
    public function __construct(Properties $actor, Dispatcher $dispatcher)
    {
        $this->actor = $actor;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return Properties
     */
    public function props(): Properties
    {
        return $this->actor;
    }

    /**
     * @param Message $message
     * @param ActorRef|null $sender
     */
    public function tell(Message $message, ActorRef $sender = null)
    {
        $this->dispatcher->dispatch($message, $this, $sender);
    }
}
