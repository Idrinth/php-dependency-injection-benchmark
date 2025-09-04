<?php

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;

class AdapterImplementation {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer([], constructors: [
            F06::class => [
                new ClassObject(E06::class),
                new ClassObject(D06::class),
                new ClassObject(B06::class),
            ],
            E06::class => [
                new ClassObject(D06::class),
                new ClassObject(C06::class),
                new ClassObject(B06::class),
            ],
            D06::class => [
                new ClassObject(C06::class),
                new ClassObject(B06::class),
                new ClassObject(A06::class),
            ],
            C06::class => [
                new ClassObject(B06::class),
            ],
            B06::class => [
                new ClassObject(A06::class),
            ],
            A06::class => [],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
