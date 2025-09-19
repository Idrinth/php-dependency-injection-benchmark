<?php

declare(strict_types=1);

require_once __DIR__ . '/CompiledContainer.php';

class AdapterImplementation
{
    private Nette\DI\Container $container;

    public function __construct()
    {
        $this->container = new CompiledContainer();
    }

    public function get(string $class): object
    {
        return $this->container->getByType($class);
    }
}
