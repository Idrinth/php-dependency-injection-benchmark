<?php

use Phalcon\Di;

class AdapterImplementation {
    private Di $container;
    public function __construct() {
        $c = new Di();
        $c->set(A06::class, fn() => new A06());
        $c->set(B06::class, fn() => new B06($c->get(A06::class)));
        $c->set(C06::class, fn() => new C06($c->get(B06::class)));
        $c->set(D06::class, fn() => new D06($c->get(C06::class), $c->get(B06::class), $c->get(A06::class)));
        $c->set(E06::class, fn() => new E06($c->get(D06::class), $c->get(C06::class), $c->get(B06::class)));
        $c->set(F06::class, fn() => new F06($c->get(E06::class), $c->get(D06::class), $c->get(B06::class)));
        $c->set(A26::class, fn() => new A26());
        $c->set(B26::class, fn() => new B26($c->get(A26::class)));
        $c->set(C26::class, fn() => new C26($c->get(B26::class)));
        $c->set(D26::class, fn() => new D26($c->get(C26::class), $c->get(B26::class), $c->get(A26::class)));
        $c->set(E26::class, fn() => new E26($c->get(D26::class), $c->get(C26::class)));
        $c->set(F26::class, fn() => new F26($c->get(E26::class), $c->get(D26::class), $c->get(B26::class)));
        $c->set(G26::class, fn() => new G26($c->get(F26::class)));
        $c->set(H26::class, fn() => new H26($c->get(G26::class), $c->get(F26::class)));
        $c->set(I26::class, fn() => new I26($c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->set(J26::class, fn() => new J26($c->get(I26::class), $c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->set(K26::class, fn() => new K26($c->get(J26::class), $c->get(I26::class), $c->get(H26::class), $c->get(G26::class), $c->get(F26::class)));
        $c->set(L26::class, fn() => new L26($c->get(K26::class), $c->get(J26::class), $c->get(I26::class), $c->get(H26::class), $c->get(G26::class)));
        $c->set(M26::class, fn() => new M26($c->get(L26::class), $c->get(K26::class), $c->get(J26::class), $c->get(I26::class), $c->get(H26::class)));
        $c->set(N26::class, fn() => new N26($c->get(M26::class), $c->get(L26::class)));
        $c->set(O26::class, fn() => new O26($c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->set(P26::class, fn() => new P26($c->get(O26::class), $c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->set(Q26::class, fn() => new Q26($c->get(P26::class), $c->get(O26::class), $c->get(N26::class), $c->get(M26::class), $c->get(L26::class)));
        $c->set(R26::class, fn() => new R26($c->get(Q26::class), $c->get(P26::class)));
        $c->set(S26::class, fn() => new S26($c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->set(T26::class, fn() => new T26($c->get(S26::class), $c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->set(U26::class, fn() => new U26($c->get(T26::class), $c->get(S26::class), $c->get(R26::class), $c->get(Q26::class), $c->get(P26::class)));
        $c->set(V26::class, fn() => new V26($c->get(U26::class)));
        $c->set(W26::class, fn() => new W26($c->get(V26::class), $c->get(U26::class)));
        $c->set(X26::class, fn() => new X26($c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $c->set(Y26::class, fn() => new Y26($c->get(X26::class), $c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $c->set(Z26::class, fn() => new Z26($c->get(Y26::class), $c->get(X26::class), $c->get(W26::class), $c->get(V26::class), $c->get(U26::class)));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
