<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Envelope;
use Pactores\Message;
use Threaded;

abstract class Actor extends Threaded
{
    private $selfRef;
    private $sender;

    public static function instantiate(ActorRef $selfRef, array $arguments): Actor
    {
        $actor = new static(...self::bindActorRefs($selfRef, $arguments));

        $actor->selfRef = $selfRef;

        return $actor;
    }

    private static function bindActorRefs(ActorRef $bindTo, array $arguments): array
    {
        return array_map(function ($argument) use ($bindTo) {
            if ($argument instanceof ActorRef) {
                return new BoundActorRef($bindTo, $argument);
            }

            return $argument;
        }, $arguments);
    }

    /**
     * @param Message $message
     * @return void
     */
    abstract public function receive(Message $message);

    public function doReceive(Envelope $envelope)
    {
        $this->sender = $envelope->sender();

        $this->receive($envelope->message());

        $this->sender = null;
    }

    protected function selfRef(): ActorRef
    {
        return $this->selfRef;
    }

    protected function sender(): ActorRef
    {
        return $this->sender;
    }
}
