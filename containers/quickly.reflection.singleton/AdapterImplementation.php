<?php

declare(strict_types=1);

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Psr\Container\ContainerInterface;

class AdapterImplementation
{
    private QuicklyContainer $container;
    public function __construct()
    {
        $this->container = new QuicklyContainer(
            ['DI_USE_REFLECTION' => 'true'],
            [],
            new class implements ContainerInterface {
                public function has(string $name): bool
                {
                    return false;
                }
                public function get(string $name): object
                {
                    throw new BadMethodCallException("Not implemented");
                }
            }
        );
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
