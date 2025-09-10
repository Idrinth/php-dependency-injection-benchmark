<?php

require __DIR__ . '/CompiledContainer.php';

class AdapterImplementation
{
    private CompiledContainer $container;
    public function __construct()
    {
        $this->container = new CompiledContainer();
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
