<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Actor\Actor;
use Worker;

final class ActorWorker extends Worker
{
    /** @var Actor */
    private $actor;

    /**
     * @param Actor $actor
     */
    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    /**
     * @return Actor
     */
    public function actor(): Actor
    {
        return $this->actor;
    }
}
