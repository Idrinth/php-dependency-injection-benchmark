<?php

use Phalcon\Di\Di;

class AdapterImplementation
{
    private Di $container;
    public function __construct()
    {
        $c = new Di();
        $c->setShared(A06::class, fn() => new A06());
        $c->setShared(B06::class, fn() => new B06($c->get(A06::class)));
        $c->setShared(C06::class, fn() => new C06($c->get(B06::class)));
        $c->setShared(D06::class, fn() => new D06($c->get(C06::class), $c->get(B06::class), $c->get(A06::class)));
        $c->setShared(E06::class, fn() => new E06($c->get(D06::class), $c->get(C06::class), $c->get(B06::class)));
        $c->setShared(F06::class, fn() => new F06($c->get(E06::class), $c->get(D06::class), $c->get(B06::class)));
        $c->setShared(A16::class, fn() => new A16());
        $c->setShared(B16::class, fn() => new B16($c->get(A16::class)));
        $c->setShared(C16::class, fn() => new C16($c->get(B16::class)));
        $c->setShared(D16::class, fn() => new D16($c->get(C16::class), $c->get(B16::class), $c->get(A16::class)));
        $c->setShared(E16::class, fn() => new E16($c->get(D16::class), $c->get(C16::class)));
        $c->setShared(F16::class, fn() => new F16($c->get(E16::class), $c->get(D16::class), $c->get(B16::class)));
        $c->setShared(G16::class, fn() => new G16($c->get(F16::class)));
        $c->setShared(H16::class, fn() => new H16($c->get(G16::class), $c->get(F16::class)));
        $c->setShared(I16::class, fn() => new I16($c->get(H16::class), $c->get(G16::class), $c->get(F16::class)));
        $c->setShared(J16::class, fn() => new J16($c->get(I16::class), $c->get(H16::class)));
        $c->setShared(K16::class, fn() => new K16($c->get(J16::class), $c->get(I16::class), $c->get(H16::class)));
        $c->setShared(L16::class, fn() => new L16($c->get(K16::class)));
        $c->setShared(M16::class, fn() => new M16($c->get(L16::class), $c->get(K16::class)));
        $c->setShared(N16::class, fn() => new N16($c->get(M16::class), $c->get(L16::class), $c->get(K16::class)));
        $c->setShared(O16::class, fn() => new O16($c->get(N16::class), $c->get(M16::class)));
        $c->setShared(P16::class, fn() => new P16($c->get(O16::class), $c->get(N16::class), $c->get(M16::class)));
        $c->setShared(A26::class, fn() => new A26());
        $c->setShared(B26::class, fn() => new B26($c->get(A26::class)));
        $c->setShared(C26::class, fn() => new C26($c->get(B26::class)));
        $c->setShared(D26::class, fn() => new D26($c->get(C26::class), $c->get(B26::class), $c->get(A26::class)));
        $c->setShared(E26::class, fn() => new E26($c->get(D26::class), $c->get(C26::class)));
        $c->setShared(F26::class, fn() => new F26($c->get(E26::class), $c->get(D26::class), $c->get(B26::class)));
        $c->setShared(G26::class, fn() => new G26($c->get(F26::class)));
        $c->setShared(H26::class, fn() => new H26($c->get(G26::class), $c->get(F26::class)));
        $c->setShared(I26::class, fn() => new I26($c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->setShared(J26::class, fn() => new J26($c->get(I26::class), $c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->setShared(K26::class, fn() => new K26($c->get(J26::class), $c->get(I26::class), $c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->setShared(L26::class, fn() => new L26($c->get(K26::class), $c->get(J26::class), $c->get(I26::class), $c->get(H26::class), $c->get(G26::class)));
        $c->setShared(M26::class, fn() => new M26($c->get(L26::class), $c->get(K26::class), $c->get(J26::class), $c->get(I26::class), $c->get(H26::class)));
        $c->setShared(N26::class, fn() => new N26($c->get(M26::class), $c->get(L26::class)));
        $c->setShared(O26::class, fn() => new O26($c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->setShared(P26::class, fn() => new P26($c->get(O26::class), $c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->setShared(Q26::class, fn() => new Q26($c->get(P26::class), $c->get(O26::class), $c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->setShared(R26::class, fn() => new R26($c->get(Q26::class), $c->get(P26::class)));
        $c->setShared(S26::class, fn() => new S26($c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->setShared(T26::class, fn() => new T26($c->get(S26::class), $c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->setShared(U26::class, fn() => new U26($c->get(T26::class), $c->get(S26::class), $c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->setShared(V26::class, fn() => new V26($c->get(U26::class)));
        $c->setShared(W26::class, fn() => new W26($c->get(V26::class), $c->get(U26::class)));
        $c->setShared(X26::class, fn() => new X26($c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $c->setShared(Y26::class, fn() => new Y26($c->get(X26::class), $c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $c->setShared(Z26::class, fn() => new Z26($c->get(Y26::class), $c->get(X26::class), $c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $this->container = $c;
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
