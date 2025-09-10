<?php

use Pimple\Container;

class AdapterImplementation
{
    private Container $container;
    public function __construct()
    {
        $c = new Container();
        $c[A06::class] = fn() => new A06();
        $c[B06::class] = fn($c) => new B06($c[A06::class]);
        $c[C06::class] = fn($c) => new C06($c[B06::class]);
        $c[D06::class] = fn($c) => new D06($c[C06::class], $c[B06::class], $c[A06::class]);
        $c[E06::class] = fn($c) => new E06($c[D06::class], $c[C06::class], $c[B06::class]);
        $c[F06::class] = fn($c) => new F06($c[E06::class], $c[D06::class], $c[B06::class]);
        $c[A16::class] = fn() => new A16();
        $c[B16::class] = fn($c) => new B16($c[A16::class]);
        $c[C16::class] = fn($c) => new C16($c[B16::class]);
        $c[D16::class] = fn($c) => new D16($c[C16::class], $c[B16::class], $c[A16::class]);
        $c[E16::class] = fn($c) => new E16($c[D16::class], $c[C16::class]);
        $c[F16::class] = fn($c) => new F16($c[E16::class], $c[D16::class], $c[B16::class]);
        $c[G16::class] = fn($c) => new G16($c[F16::class]);
        $c[H16::class] = fn($c) => new H16($c[G16::class], $c[F16::class]);
        $c[I16::class] = fn($c) => new I16($c[H16::class], $c[G16::class], $c[F16::class]);
        $c[J16::class] = fn($c) => new J16($c[I16::class], $c[H16::class]);
        $c[K16::class] = fn($c) => new K16($c[J16::class], $c[I16::class], $c[H16::class]);
        $c[L16::class] = fn($c) => new L16($c[K16::class]);
        $c[M16::class] = fn($c) => new M16($c[L16::class], $c[K16::class]);
        $c[N16::class] = fn($c) => new N16($c[M16::class], $c[L16::class], $c[K16::class]);
        $c[O16::class] = fn($c) => new O16($c[N16::class], $c[M16::class]);
        $c[P16::class] = fn($c) => new P16($c[O16::class], $c[N16::class], $c[M16::class]);
        $c[A26::class] = fn() => new A26();
        $c[B26::class] = fn($c) => new B26($c[A26::class]);
        $c[C26::class] = fn($c) => new C26($c[B26::class]);
        $c[D26::class] = fn($c) => new D26($c[C26::class], $c[B26::class], $c[A26::class]);
        $c[E26::class] = fn($c) => new E26($c[D26::class], $c[C26::class]);
        $c[F26::class] = fn($c) => new F26($c[E26::class], $c[D26::class], $c[B26::class]);
        $c[G26::class] = fn($c) => new G26($c[F26::class]);
        $c[H26::class] = fn($c) => new H26($c[G26::class], $c[F26::class]);
        $c[I26::class] = fn($c) => new I26($c[H26::class], $c[G26::class], $c[F26::class]);
        $c[J26::class] = fn($c) => new J26($c[I26::class], $c[H26::class], $c[G26::class], $c[F26::class]);
        $c[K26::class] = fn($c) => new K26($c[J26::class], $c[I26::class], $c[H26::class], $c[G26::class], $c[F26::class]);
        $c[L26::class] = fn($c) => new L26($c[K26::class], $c[J26::class], $c[I26::class], $c[H26::class], $c[G26::class]);
        $c[M26::class] = fn($c) => new M26($c[L26::class], $c[K26::class], $c[J26::class], $c[I26::class], $c[H26::class]);
        $c[N26::class] = fn($c) => new N26($c[M26::class], $c[L26::class]);
        $c[O26::class] = fn($c) => new O26($c[N26::class], $c[M26::class], $c[L26::class]);
        $c[P26::class] = fn($c) => new P26($c[O26::class], $c[N26::class], $c[M26::class], $c[L26::class]);
        $c[Q26::class] = fn($c) => new Q26($c[P26::class], $c[O26::class], $c[N26::class], $c[M26::class], $c[L26::class]);
        $c[R26::class] = fn($c) => new R26($c[Q26::class], $c[P26::class]);
        $c[S26::class] = fn($c) => new S26($c[R26::class], $c[Q26::class], $c[P26::class]);
        $c[T26::class] = fn($c) => new T26($c[S26::class], $c[R26::class], $c[Q26::class], $c[P26::class]);
        $c[U26::class] = fn($c) => new U26($c[T26::class], $c[S26::class], $c[R26::class], $c[Q26::class], $c[P26::class]);
        $c[V26::class] = fn($c) => new V26($c[U26::class]);
        $c[W26::class] = fn($c) => new W26($c[V26::class], $c[U26::class]);
        $c[X26::class] = fn($c) => new X26($c[W26::class], $c[V26::class], $c[U26::class]);
        $c[Y26::class] = fn($c) => new Y26($c[X26::class], $c[W26::class], $c[V26::class], $c[U26::class]);
        $c[Z26::class] = fn($c) => new Z26($c[Y26::class], $c[X26::class], $c[W26::class], $c[V26::class], $c[U26::class]);
        $this->container = $c;
    }
    public function get(string $class): object
    {
        return $this->container[$class];
    }
}
