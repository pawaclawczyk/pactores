<?php

declare(strict_types=1);

namespace Pactores\Actor;

final class ActorId
{
    /** @var int */
    private $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
