<?php

declare(strict_types=1);

namespace Examples;

use Examples\Protocol\InitialSignal;
use Examples\Protocol\QuoteResponse;
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
            $this->teacherRef->tell(TeacherProtocol::QuoteRequest(), $this->selfRef());
        }

        if ($message instanceof QuoteResponse) {
            print (string) $message . PHP_EOL;
        }
    }
}
