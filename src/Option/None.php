<?php

declare(strict_types = 1);

namespace Option;

final class None extends Option
{
    /**
     * @inheritdoc
     */
    public function getOrElse($else)
    {
        return $else;
    }
}
