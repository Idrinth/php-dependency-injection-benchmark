<?php
namespace Deep;

require_once 'vendor/autoload.php';

use Pimple\Container;

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

class PimpleDeepAdapter {
    private Container $container;
    public function __construct() {
        $c = new Container();
        $c[A::class] = $c->factory(fn() => new A());
        $c[B::class] = $c->factory(fn($c) => new B($c[A::class]));
        $c[C::class] = $c->factory(fn($c) => new C($c[B::class]));
        $c[D::class] = $c->factory(fn($c) => new D($c[C::class]));
        $c[E::class] = $c->factory(fn($c) => new E($c[D::class]));
        $c[F::class] = $c->factory(fn($c) => new F($c[E::class]));
        $c[G::class] = $c->factory(fn($c) => new G($c[F::class]));
        $c[H::class] = $c->factory(fn($c) => new H($c[G::class]));
        $c[I::class] = $c->factory(fn($c) => new I($c[H::class]));
        $c[J::class] = $c->factory(fn($c) => new J($c[I::class]));
        $c[K::class] = $c->factory(fn($c) => new K($c[J::class]));
        $c[L::class] = $c->factory(fn($c) => new L($c[K::class]));
        $c[M::class] = $c->factory(fn($c) => new M($c[L::class]));
        $c[N::class] = $c->factory(fn($c) => new N($c[M::class]));
        $c[O::class] = $c->factory(fn($c) => new O($c[N::class]));
        $c[P::class] = $c->factory(fn($c) => new P($c[O::class]));
        $c[Q::class] = $c->factory(fn($c) => new Q($c[P::class]));
        $c[R::class] = $c->factory(fn($c) => new R($c[Q::class]));
        $c[S::class] = $c->factory(fn($c) => new S($c[R::class]));
        $c[T::class] = $c->factory(fn($c) => new T($c[S::class]));
        $c[U::class] = $c->factory(fn($c) => new U($c[T::class]));
        $c[V::class] = $c->factory(fn($c) => new V($c[U::class]));
        $c[W::class] = $c->factory(fn($c) => new W($c[V::class]));
        $c[X::class] = $c->factory(fn($c) => new X($c[W::class]));
        $c[Y::class] = $c->factory(fn($c) => new Y($c[X::class]));
        $c[Z::class] = $c->factory(fn($c) => new Z($c[Y::class]));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container[$class];
    }
}

$adapter = new PimpleDeepAdapter();
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
    $adapter = new PimpleDeepAdapter();
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
