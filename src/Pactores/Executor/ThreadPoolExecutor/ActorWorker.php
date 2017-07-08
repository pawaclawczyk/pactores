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
     * @param string $actor
     */
    public function __construct(string $actor)
    {
        $this->actor = new $actor();
    }

    /**
     * @return Actor
     */
    public function actor(): Actor
    {
        return $this->actor;
    }
}
