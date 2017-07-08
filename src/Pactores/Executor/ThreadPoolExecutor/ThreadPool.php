<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Actor\Actor;
use TryDo\TryDo;

final class ThreadPool
{
    /** @var ActorWorker[] */
    private $pool = [];

    /**
     * @param Actor $actor
     * @return TryDo
     */
    public function workerFor(Actor $actor): TryDo
    {
        return TryDo::tryDo(function () use ($actor) : ActorWorker {
            $actorClass = get_class($actor);

            if (!isset($this->pool[$actorClass])) {
                $this->pool[$actorClass] = new ActorWorker($actor);
            }

            $worker = $this->pool[$actorClass];

            $worker->isStarted() ?: $worker->start();

            return $worker;
        });
    }

    /**
     * @return bool
     */
    public function shutdown(): bool
    {
        $success = true;

        foreach ($this->pool as $worker) {
            while ($worker->collect());
            $success = $success
                && ($worker->isShutdown() ?: $worker->shutdown());
        }

        return $success;
    }
}
