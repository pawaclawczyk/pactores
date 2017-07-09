<?php

declare(strict_types=1);

namespace Examples\DiningPhilosophers;

final class Chopstick extends \Threaded
{
    private $id;

    private $beingUsedBy;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->beingUsedBy = 0;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function beingUsedBy(): int
    {
        return $this->beingUsedBy;
    }

    public function canUse(int $philosopherId): bool
    {
        return (0 === $this->beingUsedBy)
            || ($philosopherId === $this->beingUsedBy);
    }

    public function useIt(int $philosopherId)
    {
        if ($this->canUse($philosopherId)) {
            $this->beingUsedBy = $philosopherId;
        }
    }

    public function releaseIt(int $philosopherId)
    {
        if ($this->beingUsedBy === $philosopherId) {
            $this->beingUsedBy = 0;
        }
    }
}
