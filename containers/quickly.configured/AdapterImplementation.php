<?php

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;

class AdapterImplementation {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer([], constructors: [
            F::class => [
                new ClassObject(E::class),
                new ClassObject(D::class),
                new ClassObject(B::class),
            ],
            E::class => [
                new ClassObject(D::class),
                new ClassObject(C::class),
                new ClassObject(B::class),
            ],
            D::class => [
                new ClassObject(C::class),
                new ClassObject(B::class),
                new ClassObject(A::class),
            ],
            C::class => [
                new ClassObject(B::class),
            ],
            B::class => [
                new ClassObject(A::class),
            ],
            A::class => [],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
