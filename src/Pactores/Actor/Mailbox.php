<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Option\Option;
use Option\Some;
use Pactores\Envelope;
use SplQueue;
use Countable;

final class Mailbox implements Countable
{
    /** @var Actor */
    private $owner;

    /** @var SplQueue */
    private $queue;

    /**
     * @param Actor $owner
     */
    public function __construct(Actor $owner)
    {
        $this->owner = $owner;
        $this->queue = new SplQueue();
    }

    /**
     * @return Actor
     */
    public function owner(): Actor
    {
        return $this->owner;
    }

    /**
     * @param Envelope $message
     */
    public function enqueue(Envelope $message)
    {
        $this->queue->enqueue($message);
    }

    /**
     * @return Option[Envelope]
     */
    public function dequeue(): Option
    {
        return $this->queue->isEmpty()
            ? Option::None()
            : new Some($this->queue->dequeue());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->queue->count();
    }
}
