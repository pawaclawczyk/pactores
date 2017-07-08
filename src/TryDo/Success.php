<?php

declare(strict_types = 1);

namespace TryDo;

final class Success extends TryDo
{
    /** @var mixed */
    private $result;

    /**
     * @param mixed $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @inheritdoc
     */
    public function map(callable $map): TryDo
    {
        return self::tryDo(function () use ($map) {
            return $map($this->result);
        });
    }
}
