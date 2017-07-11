<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Dispatcher;
use Pactores\Mail;

class ActorRef
{
    /** @var Properties */
    protected $actorId;

    /** @var Dispatcher */
    protected $dispatcher;

    /**
     * @param ActorId $actorId
     * @param Dispatcher $dispatcher
     */
    public function __construct(ActorId $actorId, Dispatcher $dispatcher)
    {
        $this->actorId = $actorId;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return Properties
     */
    public function props(): Properties
    {
        return $this->actorId;
    }

    /**
     * @param mixed $message
     */
    public function tell($message)
    {
        $this->dispatcher->send(new Mail($message, $this->actorId));
    }
}
