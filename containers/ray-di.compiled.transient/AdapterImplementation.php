<?php

declare(strict_types=1);

use Ray\Compiler\CompiledInjector;

class AdapterImplementation
{
    private CompiledInjector $injector;
    public function __construct()
    {
        $dir = __DIR__ . '/compiled';
        $this->injector = new CompiledInjector($dir);
    }
    public function get(string $class): object
    {
        return $this->injector->getInstance($class);
    }
}
