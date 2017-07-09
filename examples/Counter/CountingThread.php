<?php

declare(strict_types=1);

namespace Examples\Counter;

final class CountingThread extends \Thread
{
    private $counter;

    public function __construct(Counter $counter)
    {
        $this->counter = $counter;
    }

    public function run()
    {
        print "Running..." . PHP_EOL;

        for ($i = 0; $i < 10000; ++$i) {
            print "Incrementing..." . PHP_EOL;

            $this->counter->increment();

            print "Current count: {$this->counter->count()}" . PHP_EOL;
        }
    }

    public function count()
    {
        return $this->counter->count();
    }
}
