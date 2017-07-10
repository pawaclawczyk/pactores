<?php

declare(strict_types=1);

namespace Examples\DiningPhilosophers;

use Time\Microseconds;

final class Philosopher extends \Thread
{
    private $id;
    private $left;
    private $right;
    private $eatLeastTime;

    public function __construct(int $id, Chopstick $left, Chopstick $right)
    {
        $this->id = $id;

        $this->left = $left;
        $this->right = $right;

//        $this->left = ($left->id() < $right->id()) ? $left : $right;
//        $this->right = ($left->id() < $right->id()) ? $right : $left;

        $this->eatLeastTime = Microseconds::now();
    }

    public function run()
    {
        while (true) {
            print "{$this->id} is thinking..." . PHP_EOL;
            usleep(random_int(1000000, 5000000));

            $id = $this->id;

            while ($this->synchronized(function (Chopstick $left, Chopstick $right) use ($id) {
                $time = Microseconds::now()->sub($this->eatLeastTime)->toSeconds();
                print "$id haven't eat for $time seconds" . PHP_EOL;

                if (!$left->canUse($id)) {
                    print "$id cannot use left({$left->beingUsedBy()})" . PHP_EOL;

                    return $left->wait();
                }

                $left->useIt($id);

                if (!$right->canUse($id)) {
                    print "$id cannot use right({$right->beingUsedBy()})" . PHP_EOL;

                    return $right->wait();
                }

                $right->useIt($id);

                print "$id is eating... with left({$left->beingUsedBy()}) and right({$right->beingUsedBy()})" . PHP_EOL;
                usleep(random_int(1000000, 5000000));

                $this->eatLeastTime = Microseconds::now();

                $left->releaseIt($id);
                $left->notify();

                $right->releaseIt($id);
                $right->notify();
            }, $this->left, $this->right)) ;

            if (Microseconds::now()->sub($this->eatLeastTime)->toSeconds() > 180) {
                $this->synchronized(function (Chopstick $left, Chopstick $right) {
                    $left->releaseIt($this->id);
                    $right->releaseIt($this->id);
                }, $this->left, $this->right);

                print "{$this->id} is leaving." . PHP_EOL;

                return true;
            }
        }
    }
}
