<?php
namespace Deep;

require_once 'vendor/autoload.php';

use Illuminate\Container\Container;

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

class LaravelDeepAdapter {
    private Container $container;
    public function __construct() {
        $this->container = new Container();
    }
    public function get(string $class): object {
        return $this->container->make($class);
    }
}

$adapter = new LaravelDeepAdapter();
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
    $adapter = new LaravelDeepAdapter();
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
