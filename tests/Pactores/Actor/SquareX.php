<?php

declare(strict_types = 1);

namespace Pactores\Actor;

use Pactores\Message;

final class SquareX implements Message
{
    private $file;
    private $x;

    public function __construct(string $file, int $x)
    {
        $this->file = $file;
        $this->x = $x;
    }

    public function file()
    {
        return $this->file;
    }

    public function x()
    {
        return $this->x;
    }
}
