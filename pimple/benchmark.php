<?php
require_once 'vendor/autoload.php';

use Pimple\Container;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c, B $b, A $a) {} }
class E { public function __construct(D $d, C $c, B $b) {} }
class F { public function __construct(E $e, D $d, B $b) {} }

class PimpleAdapter {
    private Container $container;
    public function __construct() {
        $c = new Container();
        $c[A::class] = $c->factory(fn() => new A());
        $c[B::class] = $c->factory(fn($c) => new B($c[A::class]));
        $c[C::class] = $c->factory(fn($c) => new C($c[B::class]));
        $c[D::class] = $c->factory(fn($c) => new D($c[C::class], $c[B::class], $c[A::class]));
        $c[E::class] = $c->factory(fn($c) => new E($c[D::class], $c[C::class], $c[B::class]));
        $c[F::class] = $c->factory(fn($c) => new F($c[E::class], $c[D::class], $c[B::class]));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container[$class];
    }
}

$adapter = new PimpleAdapter();
$iterations = 10000;
$runs = 5;
$times = [];
for ($j = 0; $j < $runs; $j++) {
    $start = microtime(true);
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(F::class);
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
    $adapter = new PimpleAdapter();
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(F::class);
        unset($object);
    }
    $time = microtime(true) - $start;
    $times[] = $time;
    echo "run $j: $time seconds per $iterations\n";
}

echo "\nAVERAGE | MINIMUM | MAXIMUM\n";
echo (array_sum($times)/count($times)) . " | " . min($times) . " | " . max($times) . "\n";

require __DIR__ . '/benchmark-26.php';
