<?php

declare(strict_types = 1);

namespace Pactores\Executor;

use Pactores\Actor\Mailbox;
use TryDo\TryDo;

interface Executor
{
    /**
     * @param Mailbox $mailbox
     * @return void
     */
    public function execute(Mailbox $mailbox);

    /**
     * @return bool
     */
    public function shutdown(): bool;
}
