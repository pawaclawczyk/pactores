<?php

declare(strict_types=1);

namespace Pactores\Actor;

final class Properties
{
    /** @var string */
    private $actorClass;

    /** @var array */
    private $constructorArguments;

    /**
     * @param string $actorClass
     * @param array $constructorArguments
     */
    public function __construct(string $actorClass, array $constructorArguments = [])
    {
        $this->actorClass = $actorClass;
        $this->constructorArguments = $constructorArguments;
    }

    /**
     * @return string
     */
    public function actorClass(): string
    {
        return $this->actorClass;
    }

    /**
     * @return array
     */
    public function constructorArguments(): array
    {
        return $this->constructorArguments;
    }
}
