<?php

declare(strict_types=1);

use DI\ContainerBuilder;

use function DI\create;
use function DI\get;

class AdapterImplementation
{
    private \DI\Container $container;
    public function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            A06::class => create(),
            B06::class => create()->constructor(get(A06::class)),
            C06::class => create()->constructor(get(B06::class)),
            D06::class => create()->constructor(get(C06::class), get(B06::class), get(A06::class)),
            E06::class => create()->constructor(get(D06::class), get(C06::class), get(B06::class)),
            F06::class => create()->constructor(get(E06::class), get(D06::class), get(B06::class)),
        ]);
        $this->container = $builder->build();
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
