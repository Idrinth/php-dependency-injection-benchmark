<?php

use Pimple\Container;

class AdapterImplementation {
    private Container $container;
    public function __construct() {
        $c = new Container();
        $c[A06::class] = $c->factory(fn() => new A06());
        $c[B06::class] = $c->factory(fn($c) => new B06($c[A06::class]));
        $c[C06::class] = $c->factory(fn($c) => new C06($c[B06::class]));
        $c[D06::class] = $c->factory(fn($c) => new D06($c[C06::class], $c[B06::class], $c[A06::class]));
        $c[E06::class] = $c->factory(fn($c) => new E06($c[D06::class], $c[C06::class], $c[B06::class]));
        $c[F06::class] = $c->factory(fn($c) => new F06($c[E06::class], $c[D06::class], $c[B06::class]));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container[$class];
    }
}
