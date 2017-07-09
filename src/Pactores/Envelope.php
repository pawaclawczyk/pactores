<?php

declare(strict_types=1);

namespace Pactores;

use Pactores\Actor\ActorRef;

final class Envelope
{
    private $message;
    private $recipient;
    private $sender;

    public function __construct(Message $message, ActorRef $recipient = null, ActorRef $sender = null)
    {
        $this->message = $message;
        $this->recipient = $recipient;
        $this->sender = $sender;
    }

    public function message(): Message
    {
        return $this->message;
    }

    public function sender()
    {
        return $this->sender;
    }
}
