<?php

declare(strict_types = 1);

namespace Examples;

require_once __DIR__.'/../vendor/autoload.php';

use Pactores\Actor\Props;
use Pactores\ActorSystem;
use Pactores\Debug;

final class StudentSimulatorApp
{
    public static function main()
    {
        $actorSystem = new ActorSystem();

        $teacherActorRef = $actorSystem->actorOf(new Props(TeacherActor::class));
        $studentRef = $actorSystem->actorOf(new Props(StudentActor::class, [$teacherActorRef]));

        $studentRef->tell(TeacherProtocol::InitialSignal());

        Debug::println('Main -- sleep for seconds.');

        sleep(2);

        Debug::println('Main -- wake up.');

        $actorSystem->shutdown();
    }
}

StudentSimulatorApp::main();
