<?php

declare(strict_types=1);

namespace Time;

final class Microtime
{
    private $microseconds = 0;

    public static function now()
    {
        list($stringMicroseconds, $stringSeconds) = explode(' ', microtime(false));

        $microseconds = (int) ($stringSeconds . substr($stringMicroseconds, 2, 6));

        return new self($microseconds);
    }

    public function sub(Microtime $other): Microtime
    {
        return new self($this->microseconds - $other->microseconds);
    }

    public function roundToSeconds()
    {
        return (int) ($this->microseconds / 1000000);
    }

    public function __toString(): string
    {
        return (string) $this->microseconds;
    }

    private function __construct(int $microseconds)
    {
        $this->microseconds = $microseconds;
    }
}
