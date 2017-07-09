<?php

declare(strict_types=1);

namespace Pactores\Actor;

final class Props
{
    /** @var string */
    private $class;

    /** @var array */
    private $arguments;

    /**
     * @param string $class
     * @param array $arguments
     */
    public function __construct(string $class, array $arguments = [])
    {
        $this->class = $class;
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    public function constructor(): array
    {
        return [
            $this->class,
            $this->arguments,
        ];
    }
}
