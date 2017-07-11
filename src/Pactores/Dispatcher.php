<?php

declare(strict_types = 1);

namespace Pactores;

use Pactores\Actor\Mailbox;
use Pactores\Executor\Executor;

/*final*/ class Dispatcher
{
    /** @var Executor */
    private $executor;

    /**
     * @param Executor $executor
     */
    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * @param Mail $mail
     */
    public function send(Mail $mail)
    {
        trigger_error('Not implemented yet.');
    }
}
