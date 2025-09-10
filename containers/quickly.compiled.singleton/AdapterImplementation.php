<?php

use Idrinth\Quickly\Built\DependendyInjection\Container as QuicklyContainer;
use Psr\Container\ContainerInterface;

require __DIR__ . '/.quickly/Container.php';

class AdapterImplementation
{
    private QuicklyContainer $container;
    public function __construct()
    {
        $this->container = new QuicklyContainer([], new class implements ContainerInterface {
            public function has(string $name): bool
            {
                return false;
            }
            public function get(string $name): object
            {
                throw new BadMethodCallException("Not implemented");
            }
        });
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
