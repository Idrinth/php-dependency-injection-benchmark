<?php

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;

class AdapterImplementation {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer([], new class implements ContainerInterface {
            public function has(string $name): bool {
                return false;
            }
            public function get(string $name): object {
                throw new BadMethodCallException("Not implemented");
            }
        }, constructors: [
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
            P16::class => [
                new ClassObject(O16::class),
                new ClassObject(N16::class),
                new ClassObject(M16::class),
            ],
            O16::class => [
                new ClassObject(N16::class),
                new ClassObject(M16::class),
            ],
            N16::class => [
                new ClassObject(M16::class),
                new ClassObject(L16::class),
                new ClassObject(K16::class),
            ],
            M16::class => [
                new ClassObject(L16::class),
                new ClassObject(K16::class),
            ],
            L16::class => [
                new ClassObject(K16::class),
            ],
            K16::class => [
                new ClassObject(J16::class),
                new ClassObject(I16::class),
                new ClassObject(H16::class),
            ],
            J16::class => [
                new ClassObject(I16::class),
                new ClassObject(H16::class),
            ],
            I16::class => [
                new ClassObject(H16::class),
                new ClassObject(G16::class),
                new ClassObject(F16::class),
            ],
            H16::class => [
                new ClassObject(G16::class),
                new ClassObject(F16::class),
            ],
            G16::class => [
                new ClassObject(F16::class),
            ],
            F16::class => [
                new ClassObject(E16::class),
                new ClassObject(D16::class),
                new ClassObject(B16::class),
            ],
            E16::class => [
                new ClassObject(D16::class),
                new ClassObject(C16::class),
            ],
            D16::class => [
                new ClassObject(C16::class),
                new ClassObject(B16::class),
                new ClassObject(A16::class),
            ],
            C16::class => [
                new ClassObject(B16::class),
            ],
            B16::class => [
                new ClassObject(A16::class),
            ],
            A16::class => [],
            Z26::class => [
                new ClassObject(Y26::class),
                new ClassObject(X26::class),
                new ClassObject(W26::class),
                new ClassObject(V26::class),
                new ClassObject(U26::class),
            ],
            Y26::class => [
                new ClassObject(X26::class),
                new ClassObject(W26::class),
                new ClassObject(V26::class),
                new ClassObject(U26::class),
            ],
            X26::class => [
                new ClassObject(W26::class),
                new ClassObject(V26::class),
                new ClassObject(U26::class),
            ],
            W26::class => [
                new ClassObject(V26::class),
                new ClassObject(U26::class),
            ],
            V26::class => [
                new ClassObject(U26::class),
            ],
            U26::class => [
                new ClassObject(T26::class),
                new ClassObject(S26::class),
                new ClassObject(R26::class),
                new ClassObject(Q26::class),
                new ClassObject(P26::class),
            ],
            T26::class => [
                new ClassObject(S26::class),
                new ClassObject(R26::class),
                new ClassObject(Q26::class),
                new ClassObject(P26::class),
            ],
            S26::class => [
                new ClassObject(R26::class),
                new ClassObject(Q26::class),
                new ClassObject(P26::class),
            ],
            R26::class => [
                new ClassObject(Q26::class),
                new ClassObject(P26::class),
            ],
            Q26::class => [
                new ClassObject(P26::class),
                new ClassObject(O26::class),
                new ClassObject(N26::class),
                new ClassObject(M26::class),
                new ClassObject(L26::class),
            ],
            P26::class => [
                new ClassObject(O26::class),
                new ClassObject(N26::class),
                new ClassObject(M26::class),
                new ClassObject(L26::class),
            ],
            O26::class => [
                new ClassObject(N26::class),
                new ClassObject(M26::class),
                new ClassObject(L26::class),
            ],
            N26::class => [
                new ClassObject(M26::class),
                new ClassObject(L26::class),
            ],
            M26::class => [
                new ClassObject(L26::class),
                new ClassObject(K26::class),
                new ClassObject(J26::class),
                new ClassObject(I26::class),
                new ClassObject(H26::class),
            ],
            L26::class => [
                new ClassObject(K26::class),
                new ClassObject(J26::class),
                new ClassObject(I26::class),
                new ClassObject(H26::class),
                new ClassObject(G26::class),
            ],
            K26::class => [
                new ClassObject(J26::class),
                new ClassObject(I26::class),
                new ClassObject(H26::class),
                new ClassObject(G26::class),
                new ClassObject(F26::class),
            ],
            J26::class => [
                new ClassObject(I26::class),
                new ClassObject(H26::class),
                new ClassObject(G26::class),
                new ClassObject(F26::class),
            ],
            I26::class => [
                new ClassObject(H26::class),
                new ClassObject(G26::class),
                new ClassObject(F26::class),
            ],
            H26::class => [
                new ClassObject(G26::class),
                new ClassObject(F26::class),
            ],
            G26::class => [
                new ClassObject(F26::class),
            ],
            F26::class => [
                new ClassObject(E26::class),
                new ClassObject(D26::class),
                new ClassObject(B26::class),
            ],
            E26::class => [
                new ClassObject(D26::class),
                new ClassObject(C26::class),
            ],
            D26::class => [
                new ClassObject(C26::class),
                new ClassObject(B26::class),
                new ClassObject(A26::class),
            ],
            C26::class => [
                new ClassObject(B26::class),
            ],
            B26::class => [
                new ClassObject(A26::class),
            ],
            A26::class => [],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
