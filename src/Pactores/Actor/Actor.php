<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Threaded;

abstract class Actor extends Threaded
{
    abstract public function receive();
}
