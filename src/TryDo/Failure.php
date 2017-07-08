<?php

declare(strict_types = 1);

namespace TryDo;

use Throwable;

final class Failure extends TryDo
{
    private $error;

    public function __construct(Throwable $error)
    {
        $this->error = $error;
    }

    /**
     * @inheritdoc
     */
    public function map(callable $map): TryDo
    {
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('Failure[%s : "%s"]', get_class($this->error), $this->error->getMessage());
    }
}
