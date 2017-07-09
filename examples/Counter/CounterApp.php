<?php

declare(strict_types=1);

namespace Examples\Counter;

require_once __DIR__.'/../../vendor/autoload.php';

final class CounterApp
{
    public static function main()
    {
        $counter = new Counter();

        $countingThread1 = new CountingThread($counter);
        $countingThread2 = new CountingThread($counter);

        $countingThread1->start();
        $countingThread2->start();

        $countingThread1->join();
        $countingThread2->join();

        print $counter->count() . PHP_EOL;
        print $countingThread1->count() . PHP_EOL;
        print $countingThread2->count() . PHP_EOL;
    }
}

CounterApp::main();
