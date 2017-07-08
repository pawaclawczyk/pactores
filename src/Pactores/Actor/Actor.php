<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Message;

abstract class Actor
{
    /**
     * @param Message $message
     * @return void
     */
    abstract public function receive(Message $message);
}
