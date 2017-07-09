<?php

declare(strict_types = 1);

namespace Examples;

use Examples\Protocol\QuoteRequest;
use Pactores\Actor\Actor;
use Pactores\Message;

final class TeacherActor extends Actor
{
    private $quotes = [
        '"Only two things are infinite, the universe and human stupidity, and I\'m not sure about the former." - Albert Einstein',
        '"Science is about knowing; engineering is about doing." - Henry Petroski',
        '"Your theory is crazy, but it\'s not crazy enough to be true." - Niels Bohr',
        '"Definition of Statistics: The science of producing unreliable facts from reliable figures." - Evan Esar',
        '"Observation is a passive science, experimentation an active science." - Claude Bernard',
    ];

    public function receive(Message $message)
    {
        if ($message instanceof QuoteRequest) {
            usleep(random_int(50000, 500000));

            $quote = $this->quotes[random_int(0, 4)];

            $this->sender()->tell(TeacherProtocol::QuoteResponse($quote));
        }
    }
}
