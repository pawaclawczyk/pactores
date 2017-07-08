<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Message;

final class MathDoctor extends Actor
{
    public function receive(Message $message)
    {
        if ($message instanceof SquareX) {
            $stream = fopen($message->file(), 'w+');

            fwrite($stream, (string)($message->x() * $message->x()));

            fclose($stream);
        }
    }
}
