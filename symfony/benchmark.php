<?php
require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c, B $b, A $a) {} }
class E { public function __construct(D $d, C $c, B $b) {} }
class F { public function __construct(E $e, D $d, B $b) {} }

class SymfonyDiAdapter {
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
            ->addArgument(new Reference(C::class))
            ->addArgument(new Reference(B::class))
            ->addArgument(new Reference(A::class));
        $c->register(E::class, E::class)
            ->setPublic(true)
            ->addArgument(new Reference(D::class))
            ->addArgument(new Reference(C::class))
            ->addArgument(new Reference(B::class));
        $c->register(F::class, F::class)
            ->setPublic(true)
            ->addArgument(new Reference(E::class))
            ->addArgument(new Reference(D::class))
            ->addArgument(new Reference(B::class));
        $c->compile();
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

$adapter = new SymfonyDiAdapter();
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
    $adapter = new SymfonyDiAdapter();
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
