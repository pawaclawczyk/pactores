<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\ActorRef;
use Pactores\Actor\Props;
use Pactores\Executor\Executor;
use Pactores\Executor\ThreadPoolExecutor\ThreadPoolExecutor;

final class ActorSystem
{
    /** @var Executor */
    private $executor;

    /** @var Dispatcher  */
    private $dispatcher;

    public function __construct()
    {
        $this->executor = new ThreadPoolExecutor();
        $this->dispatcher = new Dispatcher($this->executor);
    }

    /**
     * @todo handle not existing actor
     */
    /**
     * @param Props $actor
     * @return ActorRef
     */
    public function actorOf(Props $actor): ActorRef
    {
        return new ActorRef($actor, $this->dispatcher);
    }

    /**
     * @return bool
     */
    public function shutdown(): bool
    {
        return $this->executor->shutdown();
    }
}
