<?php

declare(strict_types = 1);

namespace Option;

final class Some extends Option
{
    /** @var mixed */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getOrElse($else)
    {
        return $this->value;
    }
}
