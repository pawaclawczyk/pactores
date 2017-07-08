<?php

declare(strict_types = 1);

namespace Examples;

require_once __DIR__.'/../vendor/autoload.php';

use Pactores\ActorSystem;

final class StudentSimulatorApp
{
    public static function main()
    {
        $actorSystem = new ActorSystem();

        $teacherActorRef = $actorSystem->actorOf(TeacherActor::class);

        for ($i = 0; $i < 10; $i++) {
            usleep(random_int(50000, 500000));

            print "QuoteRequest: $i" . PHP_EOL;
            $teacherActorRef->tell(TeacherProtocol::QuoteRequest());
        }

        sleep(2);

        $actorSystem->shutdown();
    }
}

StudentSimulatorApp::main();
