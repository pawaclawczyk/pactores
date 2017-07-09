<?php

declare(strict_types=1);

namespace Examples\Counter;

final class Counter extends \Threaded
{
    private $count = 0;

    public function increment()
    {
        $this->synchronized(function (Counter $counter) {
            ++$counter->count;
        }, $this);
    }

    public function count(): int
    {
        return $this->synchronized(function (Counter $counter) {
            return $this->count;
        }, $this);
    }
}
