<?php

declare(strict_types=1);

namespace Debug;

use Time\Microseconds;

final class Debug
{
    public static function println(string $line)
    {
        $now = Microseconds::now();

        printf('DEBUG: %s: %s%s', self::formatDateTime($now), $line, PHP_EOL);
    }

    private static function formatDateTime(Microseconds $microseconds)
    {
        $milliseconds = (string) $microseconds->toMilliseconds();
        $length = strlen($milliseconds);
        $secondsPart = (int)substr($milliseconds, 0, $length - 3);
        $millisecondsPart = substr($milliseconds, $length - 3);
        $dateTimePart = date('Y-m-d H:i:s', $secondsPart);

        return sprintf('%s.%s', $dateTimePart, $millisecondsPart);
    }
}
