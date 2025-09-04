<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AdapterImplementation {
    private ContainerBuilder $container;
    public function __construct() {
        $c = new ContainerBuilder();
        $c->register(A::class, A::class)->setPublic(true);
        $c->register(B::class, B::class)
            ->setPublic(true)
            ->addArgument(new Reference(A::class));
        $c->register(C::class, C::class)
            ->setPublic(true)
            ->addArgument(new Reference(B::class));
        $c->register(D::class, D::class)
            ->setPublic(true)
            ->addArgument(new Reference(C::class))
            ->addArgument(new Reference(B::class))
            ->addArgument(new Reference(A::class));
        $c->register(E::class, E::class)
            ->setPublic(true)
            ->addArgument(new Reference(D::class))
            ->addArgument(new Reference(C::class))
            ->addArgument(new Reference(B::class));
        $c->register(F::class, F::class)
            ->setPublic(true)
            ->addArgument(new Reference(E::class))
            ->addArgument(new Reference(D::class))
            ->addArgument(new Reference(B::class));
        $c->compile();
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
