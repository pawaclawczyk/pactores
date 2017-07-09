<?php

declare(strict_types=1);

namespace Examples\DiningPhilosophers;

require_once __DIR__ . '/../../vendor/autoload.php';

final class App
{
    public static function main()
    {
        $s1 = new Chopstick(1);
        $s2 = new Chopstick(2);
        $s3 = new Chopstick(3);
        $s4 = new Chopstick(4);
        $s5 = new Chopstick(5);

        $p1 = new Philosopher(1, $s1, $s2);
        $p2 = new Philosopher(2, $s2, $s3);
        $p3 = new Philosopher(3, $s3, $s4);
        $p4 = new Philosopher(4, $s4, $s5);
        $p5 = new Philosopher(5, $s5, $s1);

        $p1->start();
        $p2->start();
        $p3->start();
        $p4->start();
        $p5->start();

        $p1->join();
        $p2->join();
        $p3->join();
        $p4->join();
        $p5->join();
    }
}

App::main();
