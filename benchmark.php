<?php
require_once 'vendor/autoload.php';

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Idrinth\Quickly\DependencyInjection\Definitions\ClassObject;
use Pimple\Container as PimpleContainer;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

class A {}
class B { public function __construct(A $a) {} }
class C { public function __construct(B $b) {} }
class D { public function __construct(C $c, B $b, A $a) {} }
class E { public function __construct(D $d, C $c, B $b) {} }
class F { public function __construct(E $e, D $d, B $b) {} }

interface Adapter { public function get(string $class): object; }

class QuicklyReflectionAdapter implements Adapter {
    public function get(string $class): object {
        $container = new QuicklyContainer(['DI_USE_REFLECTION' => 'true']);
        return $container->get($class);
    }
}

class QuicklyConfiguredAdapter implements Adapter {
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

class PimpleAdapter implements Adapter {
    private PimpleContainer $container;
    public function __construct() {
        $c = new PimpleContainer();
        $c[A::class] = $c->factory(function () { return new A(); });
        $c[B::class] = $c->factory(function ($c) { return new B($c[A::class]); });
        $c[C::class] = $c->factory(function ($c) { return new C($c[B::class]); });
        $c[D::class] = $c->factory(function ($c) { return new D($c[C::class], $c[B::class], $c[A::class]); });
        $c[E::class] = $c->factory(function ($c) { return new E($c[D::class], $c[C::class], $c[B::class]); });
        $c[F::class] = $c->factory(function ($c) { return new F($c[E::class], $c[D::class], $c[B::class]); });
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container[$class];
    }
}

class PhpDiAdapter implements Adapter {
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

$adapters = [
    'quickly-reflection' => new QuicklyReflectionAdapter(),
    'quickly-configured' => new QuicklyConfiguredAdapter(),
    'pimple' => new PimpleAdapter(),
    'php-di' => new PhpDiAdapter(),
];

$iterations = 10000;
$runs = 5;
$times = [];

for ($j = 0; $j < $runs; $j++) {
    foreach ($adapters as $name => $adapter) {
        $start = microtime(true);
        for ($i = 0; $i < $iterations; $i++) {
            $object = $adapter->get(F::class);
            unset($object);
        }
        $time = microtime(true) - $start;
        $times[$name][] = $time;
        echo $name . " run $j: $time seconds per $iterations" . PHP_EOL;
    }
}

echo "\nTYPE | AVERAGE | MINIMUM | MAXIMUM\n";
foreach ($times as $type => $results) {
    $avg = array_sum($results)/count($results);
    echo $type . " | $avg | " . min($results) . " | " . max($results) . PHP_EOL;
}
