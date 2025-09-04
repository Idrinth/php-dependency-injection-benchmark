<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AdapterImplementation {
    private ContainerBuilder $container;
    public function __construct() {
        $c = new ContainerBuilder();
        $c->register(A06::class, A06::class)->setPublic(true);
        $c->register(B06::class, B06::class)
            ->setPublic(true)
            ->addArgument(new Reference(A06::class));
        $c->register(C06::class, C06::class)
            ->setPublic(true)
            ->addArgument(new Reference(B06::class));
        $c->register(D06::class, D06::class)
            ->setPublic(true)
            ->addArgument(new Reference(C06::class))
            ->addArgument(new Reference(B06::class))
            ->addArgument(new Reference(A06::class));
        $c->register(E06::class, E06::class)
            ->setPublic(true)
            ->addArgument(new Reference(D06::class))
            ->addArgument(new Reference(C06::class))
            ->addArgument(new Reference(B06::class));
        $c->register(F06::class, F06::class)
            ->setPublic(true)
            ->addArgument(new Reference(E06::class))
            ->addArgument(new Reference(D06::class))
            ->addArgument(new Reference(B06::class));
        $c->compile();
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
