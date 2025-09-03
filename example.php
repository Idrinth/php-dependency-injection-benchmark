<?php

require_once 'vendor/autoload.php';

class A {}
class B {
    public function __construct(A $a)
    {
    }
}
class C {
    public function __construct(B $b)
    {
    }
}
class D {
    public function __construct(C $c, B $b, A $a)
    {
    }
}
class E {
    public function __construct(D $d, C $c, B $b)
    {
    }
}
class F {
    public function __construct(E $e, D $d, B $b)
    {
    }
}
$times = [
    'simple-configured-cached' => [],
    'simple-configured-unvalidated' => [],
    'simple-configured' => [],
    'simple-reflected' => [],
    'medium-configured-cached' => [],
    'medium-configured-unvalidated' => [],
    'medium-configured' => [],
    'medium-reflected' => [],
];

for ($j = 0; $j < 10; $j++) {
    echo "Starting with reflection (simple)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $devContainer = new \Idrinth\Quickly\DependencyInjection\Container(['DI_USE_REFLECTION' => 'true']);
        $intendedObject = $devContainer->get(stdClass::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['simple-reflected'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured (simple)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container([], constructors: [
            stdClass::class => [],
        ]);
        $intendedObject = $devContainer->get(stdClass::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['simple-configured'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured+unvalidated (simple)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container(['DI_USE_CONFIG_VALIDATION' => 'false'], constructors: [
            stdClass::class => [],
        ]);
        $intendedObject = $devContainer->get(stdClass::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['simple-configured-unvalidated'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured+cached (simple)\n";
    $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container([], constructors: [
        stdClass::class => [],
    ]);
    $intendedObject = $devContainer->get(stdClass::class);
    unset($intendedObject);
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $intendedObject = $devContainer->get(stdClass::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['simple-configured-cached'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with reflection (medium)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $devContainer = new \Idrinth\Quickly\DependencyInjection\Container(['DI_USE_REFLECTION' => 'true']);
        $intendedObject = $devContainer->get(F::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['medium-reflected'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured (medium)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container([], constructors: [
            F::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(E::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            E::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            D::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
            ],
            C::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            B::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
            ],
            A::class => [],
        ]);
        $intendedObject = $devContainer->get(F::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['medium-configured'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured+unvalidated (medium)\n";
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container(['DI_USE_CONFIG_VALIDATION' => 'false'], constructors: [
            F::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(E::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            E::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            D::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
            ],
            C::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            ],
            B::class => [
                new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
            ],
            A::class => [],
        ]);
        $intendedObject = $devContainer->get(F::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['medium-configured-unvalidated'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
    echo "Starting with configured+cached (medium)\n";
    $prodContainer = new \Idrinth\Quickly\DependencyInjection\Container([], constructors: [
        F::class => [
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(E::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
        ],
        E::class => [
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(D::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
        ],
        D::class => [
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(C::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
        ],
        C::class => [
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(B::class),
        ],
        B::class => [
            new \Idrinth\Quickly\DependencyInjection\Definitions\ClassObject(A::class),
        ],
        A::class => [],
    ]);
    $intendedObject = $devContainer->get(F::class);
    unset($intendedObject);
    $start = microtime(true);
    for($i = 0; $i < 100000; $i++) {
        $intendedObject = $devContainer->get(F::class);
        unset($intendedObject);
    }
    $time = microtime(true) - $start;
    $times['medium-configured-cached'][] = $time;
    echo "Duration: ".$time." seconds per 100,000\n";
}


echo "\n\nTYPE | AVERAGES | MINIMUM | MAXIMUM\n";
foreach ($times as $type => $results) {
    echo $type." | ".array_sum($results)/count($results)." | ".min($results)." | ".max($results)."\n";
}
