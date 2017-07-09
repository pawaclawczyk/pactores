<?php

declare(strict_types=1);

namespace Pactores\Actor;

use Pactores\Message;

final class BoundActorRef extends ActorRef
{
    private $boundTo;

    public function __construct(ActorRef $boundTo, ActorRef $original)
    {
        parent::__construct($original->actor, $original->dispatcher);

        $this->boundTo = $boundTo;
    }

    public function tell(Message $message, ActorRef $sender = null)
    {
        parent::tell($message, $this->boundTo);
    }
}
