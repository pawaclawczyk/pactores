<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Envelope;
use Threaded;

final class MessageThreaded extends Threaded
{
    /** @var ActorWorker */
    protected $worker;

    /** @var Envelope */
    private $envelope;

    /**
     * @param Envelope $envelope
     */
    public function __construct(Envelope $envelope)
    {
        $this->envelope = $envelope;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->worker->actor()->doReceive($this->envelope);
    }
}
