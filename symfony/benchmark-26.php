<?php
namespace Deep;

require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c) {} }
class E { public function __construct(D $d) {} }
class F { public function __construct(E $e) {} }
class G { public function __construct(F $f) {} }
class H { public function __construct(G $g) {} }
class I { public function __construct(H $h) {} }
class J { public function __construct(I $i) {} }
class K { public function __construct(J $j) {} }
class L { public function __construct(K $k) {} }
class M { public function __construct(L $l) {} }
class N { public function __construct(M $m) {} }
class O { public function __construct(N $n) {} }
class P { public function __construct(O $o) {} }
class Q { public function __construct(P $p) {} }
class R { public function __construct(Q $q) {} }
class S { public function __construct(R $r) {} }
class T { public function __construct(S $s) {} }
class U { public function __construct(T $t) {} }
class V { public function __construct(U $u) {} }
class W { public function __construct(V $v) {} }
class X { public function __construct(W $w) {} }
class Y { public function __construct(X $x) {} }
class Z { public function __construct(Y $y) {} }

class SymfonyDeepAdapter {
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
            ->addArgument(new Reference(C::class));
        $c->register(E::class, E::class)
            ->setPublic(true)
            ->addArgument(new Reference(D::class));
        $c->register(F::class, F::class)
            ->setPublic(true)
            ->addArgument(new Reference(E::class));
        $c->register(G::class, G::class)
            ->setPublic(true)
            ->addArgument(new Reference(F::class));
        $c->register(H::class, H::class)
            ->setPublic(true)
            ->addArgument(new Reference(G::class));
        $c->register(I::class, I::class)
            ->setPublic(true)
            ->addArgument(new Reference(H::class));
        $c->register(J::class, J::class)
            ->setPublic(true)
            ->addArgument(new Reference(I::class));
        $c->register(K::class, K::class)
            ->setPublic(true)
            ->addArgument(new Reference(J::class));
        $c->register(L::class, L::class)
            ->setPublic(true)
            ->addArgument(new Reference(K::class));
        $c->register(M::class, M::class)
            ->setPublic(true)
            ->addArgument(new Reference(L::class));
        $c->register(N::class, N::class)
            ->setPublic(true)
            ->addArgument(new Reference(M::class));
        $c->register(O::class, O::class)
            ->setPublic(true)
            ->addArgument(new Reference(N::class));
        $c->register(P::class, P::class)
            ->setPublic(true)
            ->addArgument(new Reference(O::class));
        $c->register(Q::class, Q::class)
            ->setPublic(true)
            ->addArgument(new Reference(P::class));
        $c->register(R::class, R::class)
            ->setPublic(true)
            ->addArgument(new Reference(Q::class));
        $c->register(S::class, S::class)
            ->setPublic(true)
            ->addArgument(new Reference(R::class));
        $c->register(T::class, T::class)
            ->setPublic(true)
            ->addArgument(new Reference(S::class));
        $c->register(U::class, U::class)
            ->setPublic(true)
            ->addArgument(new Reference(T::class));
        $c->register(V::class, V::class)
            ->setPublic(true)
            ->addArgument(new Reference(U::class));
        $c->register(W::class, W::class)
            ->setPublic(true)
            ->addArgument(new Reference(V::class));
        $c->register(X::class, X::class)
            ->setPublic(true)
            ->addArgument(new Reference(W::class));
        $c->register(Y::class, Y::class)
            ->setPublic(true)
            ->addArgument(new Reference(X::class));
        $c->register(Z::class, Z::class)
            ->setPublic(true)
            ->addArgument(new Reference(Y::class));
        $c->compile();
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new SymfonyDeepAdapter();
$iterations = 10000;
$runs = 5;
$times = [];
for ($j = 0; $j < $runs; $j++) {
    $start = microtime(true);
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(Z::class);
        unset($object);
    }
    $time = microtime(true) - $start;
    $times[] = $time;
    echo "run $j: $time seconds per $iterations\n";
}

echo "\nAVERAGE | MINIMUM | MAXIMUM\n";
echo (array_sum($times)/count($times)) . " | " . min($times) . " | " . max($times) . "\n";

echo "\nINCLUDING STARTUP TIME\n";
$times = [];
for ($j = 0; $j < $runs; $j++) {
    $start = microtime(true);
    $adapter = new SymfonyDeepAdapter();
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(Z::class);
        unset($object);
    }
    $time = microtime(true) - $start;
    $times[] = $time;
    echo "run $j: $time seconds per $iterations\n";
}

echo "\nAVERAGE | MINIMUM | MAXIMUM\n";
echo (array_sum($times)/count($times)) . " | " . min($times) . " | " . max($times) . "\n";
