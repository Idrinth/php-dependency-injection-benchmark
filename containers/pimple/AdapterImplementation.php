<?php

use Pimple\Container;

class AdapterImplementation {
    private Container $container;
    public function __construct() {
        $c = new Container();
        $c[A::class] = $c->factory(fn() => new A());
        $c[B::class] = $c->factory(fn($c) => new B($c[A::class]));
        $c[C::class] = $c->factory(fn($c) => new C($c[B::class]));
        $c[D::class] = $c->factory(fn($c) => new D($c[C::class], $c[B::class], $c[A::class]));
        $c[E::class] = $c->factory(fn($c) => new E($c[D::class], $c[C::class], $c[B::class]));
        $c[F::class] = $c->factory(fn($c) => new F($c[E::class], $c[D::class], $c[B::class]));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container[$class];
    }
}
