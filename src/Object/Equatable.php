<?php

declare(strict_types=1);

namespace Object;

interface Equatable
{
    /**
     * @param mixed $other
     * @return bool
     */
    public function equals($other): bool ;
}
