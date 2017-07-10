<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\ActorId;
use Pactores\Actor\ActorRef;
use Pactores\Actor\Properties;
use Pactores\Executor\Executor;

final class ActorSystem
{
    /** @var Executor */
    private $executor;

    /** @var Dispatcher  */
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher, Executor $executor)
    {
        $this->executor = $executor;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @todo handle not existing actor
     */
    /**
     * @param Properties $actor
     * @return ActorRef
     */
    public function actorOf(Properties $actor): ActorRef
    {
        return new ActorRef(new ActorId(42), $this->dispatcher);
    }

    /**
     * @return bool
     */
    public function shutdown(): bool
    {
        return $this->executor->shutdown();
    }
}
