<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use TryDo\TryDo;

final class ThreadPool
{
    /** @var ActorWorker[] */
    private $pool = [];

    /**
     * @param string $actor
     * @return TryDo[ActorWorker, Throwable]
     */
    public function workerFor(string $actor): TryDo
    {
        return TryDo::tryDo(function () use ($actor) : ActorWorker {
            if (!isset($this->pool[$actor])) {
                $this->pool[$actor] = new ActorWorker($actor);
            }

            $worker = $this->pool[$actor];

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
