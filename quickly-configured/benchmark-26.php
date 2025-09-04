<?php
namespace Deep;

require_once 'vendor/autoload.php';

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;

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

class QuicklyConfiguredDeepAdapter {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer([], constructors: [
            Z::class => [new ClassObject(Y::class)],
            Y::class => [new ClassObject(X::class)],
            X::class => [new ClassObject(W::class)],
            W::class => [new ClassObject(V::class)],
            V::class => [new ClassObject(U::class)],
            U::class => [new ClassObject(T::class)],
            T::class => [new ClassObject(S::class)],
            S::class => [new ClassObject(R::class)],
            R::class => [new ClassObject(Q::class)],
            Q::class => [new ClassObject(P::class)],
            P::class => [new ClassObject(O::class)],
            O::class => [new ClassObject(N::class)],
            N::class => [new ClassObject(M::class)],
            M::class => [new ClassObject(L::class)],
            L::class => [new ClassObject(K::class)],
            K::class => [new ClassObject(J::class)],
            J::class => [new ClassObject(I::class)],
            I::class => [new ClassObject(H::class)],
            H::class => [new ClassObject(G::class)],
            G::class => [new ClassObject(F::class)],
            F::class => [new ClassObject(E::class)],
            E::class => [new ClassObject(D::class)],
            D::class => [new ClassObject(C::class)],
            C::class => [new ClassObject(B::class)],
            B::class => [new ClassObject(A::class)],
            A::class => [],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new QuicklyConfiguredDeepAdapter();
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
    $adapter = new QuicklyConfiguredDeepAdapter();
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
