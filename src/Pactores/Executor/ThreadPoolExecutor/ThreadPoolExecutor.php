<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use Option\Option;
use Pactores\Executor\Executor;
use Pactores\Actor\Mailbox;
use TryDo\Failure;
use TryDo\TryDo;

final class ThreadPoolExecutor implements Executor
{
    /** @var ThreadPool */
    private $pool;

    public function __construct()
    {
        $this->pool = new ThreadPool();
    }

    /**
     * @param Mailbox $mailbox
     * @return void
     */
    public function execute(Mailbox $mailbox)
    {
        $worker = $this->pool->workerFor($mailbox->owner());

        while (Option::None() != $message = $mailbox->dequeue()) {
            $worker->map(function (ActorWorker $worker) use ($message) {
                $worker
                    ->stack(new MessageThreaded($message->getOrElse(null)));
            });
        }
    }

    /**
     * @return bool
     */
    public function shutdown(): bool
    {
        return $this->pool->shutdown();
    }
}
