<?php

declare(strict_types=1);

namespace Pactores;

use Object\Equatable;
use Pactores\Actor\ActorId;

final class Mail implements Equatable
{
    /** @var mixed */
    private $message;

    /** @var ActorId */
    private $recipient;

    /**
     * @param mixed $message
     * @param ActorId $recipient
     */
    public function __construct($message, ActorId $recipient)
    {
        $this->message = $message;
        $this->recipient = $recipient;
    }

    /**
     * @inheritdoc
     */
    public function equals($other): bool
    {
        return ($other instanceof Mail)
            ? ($this->message === $other->message && $this->recipient == $other->recipient)
            : false;
    }
}
