<?php

declare(strict_types=1);

namespace Examples;

use Examples\Protocol\InitialSignal;
use Pactores\Actor\Actor;
use Pactores\Actor\ActorRef;
use Pactores\Message;

final class StudentActor extends Actor
{
    private $teacherRef;

    public function __construct(ActorRef $teacherRef)
    {
        $this->teacherRef = $teacherRef;
    }

    public function receive(Message $message)
    {
        if ($message instanceof InitialSignal) {
            $this->teacherRef->tell(TeacherProtocol::QuoteRequest());
        }
    }
}
