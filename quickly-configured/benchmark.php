<?php
require_once 'vendor/autoload.php';

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c, B $b, A $a) {} }
class E { public function __construct(D $d, C $c, B $b) {} }
class F { public function __construct(E $e, D $d, B $b) {} }

class QuicklyConfiguredAdapter {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer([], constructors: [
            F::class => [
                new ClassObject(E::class),
                new ClassObject(D::class),
                new ClassObject(B::class),
            ],
            E::class => [
                new ClassObject(D::class),
                new ClassObject(C::class),
                new ClassObject(B::class),
            ],
            D::class => [
                new ClassObject(C::class),
                new ClassObject(B::class),
                new ClassObject(A::class),
            ],
            C::class => [
                new ClassObject(B::class),
            ],
            B::class => [
                new ClassObject(A::class),
            ],
            A::class => [],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new QuicklyConfiguredAdapter();
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
