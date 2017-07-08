<?php

declare(strict_types = 1);

namespace TryDo;

use Throwable;

abstract class TryDo
{
    /**
     * @param callable $map
     * @return TryDo[mixed, Throwable]
     */
    abstract public function map(callable $map): TryDo;

    public static function tryDo(callable $do): TryDo
    {
        try {
            return new Success($do());
        } catch (Throwable $error) {
            return new Failure($error);
        }
    }
}
