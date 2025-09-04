<?php
namespace Deep;

require_once 'vendor/autoload.php';

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

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

class PhpDiDeepAdapter {
    private \DI\Container $container;
    public function __construct() {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            A::class => create(),
            B::class => create()->constructor(get(A::class)),
            C::class => create()->constructor(get(B::class)),
            D::class => create()->constructor(get(C::class)),
            E::class => create()->constructor(get(D::class)),
            F::class => create()->constructor(get(E::class)),
            G::class => create()->constructor(get(F::class)),
            H::class => create()->constructor(get(G::class)),
            I::class => create()->constructor(get(H::class)),
            J::class => create()->constructor(get(I::class)),
            K::class => create()->constructor(get(J::class)),
            L::class => create()->constructor(get(K::class)),
            M::class => create()->constructor(get(L::class)),
            N::class => create()->constructor(get(M::class)),
            O::class => create()->constructor(get(N::class)),
            P::class => create()->constructor(get(O::class)),
            Q::class => create()->constructor(get(P::class)),
            R::class => create()->constructor(get(Q::class)),
            S::class => create()->constructor(get(R::class)),
            T::class => create()->constructor(get(S::class)),
            U::class => create()->constructor(get(T::class)),
            V::class => create()->constructor(get(U::class)),
            W::class => create()->constructor(get(V::class)),
            X::class => create()->constructor(get(W::class)),
            Y::class => create()->constructor(get(X::class)),
            Z::class => create()->constructor(get(Y::class)),
        ]);
        $this->container = $builder->build();
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new PhpDiDeepAdapter();
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
    $adapter = new PhpDiDeepAdapter();
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
