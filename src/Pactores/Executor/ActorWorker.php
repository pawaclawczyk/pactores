<?php

declare(strict_types = 1);

namespace Pactores\Executor;

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
     * @inheritdoc
     */
    public function start(int $options = null)
    {
        return parent::start(PTHREADS_INHERIT_NONE);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        require_once __DIR__.'/../../../../vendor/autoload.php';
    }

    /**
     * @return Actor
     */
    public function actor(): Actor
    {
        return $this->actor;
    }
}
