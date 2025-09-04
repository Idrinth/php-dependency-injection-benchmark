<?php

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

class AdapterImplementation {
    private \DI\Container $container;
    public function __construct() {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            A::class => create(),
            B::class => create()->constructor(get(A::class)),
            C::class => create()->constructor(get(B::class)),
            D::class => create()->constructor(get(C::class), get(B::class), get(A::class)),
            E::class => create()->constructor(get(D::class), get(C::class), get(B::class)),
            F::class => create()->constructor(get(E::class), get(D::class), get(B::class)),
        ]);
        $this->container = $builder->build();
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
