<?php

declare(strict_types = 1);

namespace Option;

abstract class Option
{
    /** @var None|null */
    private static $none;

    /**
     * @return None
     */
    public static function None(): None
    {
        /**
         * @todo use memoization
         */
        if (null === self::$none) {
            self::$none = new None();
        }

        return self::$none;
    }

    /**
     * @param mixed $else
     * @return mixed
     */
    abstract public function getOrElse($else);
}
