<?php

declare(strict_types = 1);

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Message;
use Threaded;

final class MessageThreaded extends Threaded
{
    /** @var ActorWorker */
    protected $worker;

    /**
     * @var Message
     */
    private $message;

    /**
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->worker->actor()->receive($this->message);
    }
}
