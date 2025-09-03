<?php
require_once 'vendor/autoload.php';

use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c, B $b, A $a) {} }
class E { public function __construct(D $d, C $c, B $b) {} }
class F { public function __construct(E $e, D $d, B $b) {} }

class PhpDiAdapter {
    private \DI\Container $container;
    public function __construct() {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            A::class => create(),
            B::class => create()->constructor(get(A::class)),
            C::class => create()->constructor(get(B::class)),
            D::class => create()->constructor(get(C::class), get(B::class), get(A::class)),
            E::class => create()->constructor(get(D::class), get(C::class), get(B::class)),
            F::class => create()->constructor(get(E::class), get(D::class), get(B::class)),
        ]);
        $this->container = $builder->build();
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new PhpDiAdapter();
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
    $adapter = new PhpDiAdapter();
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
