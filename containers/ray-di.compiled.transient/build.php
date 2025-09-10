<?php

use Ray\Compiler\Compiler;
use Ray\Di\AbstractModule;

require __DIR__ . '/vendor/autoload.php';

$srcDir = __DIR__;
require $srcDir . '/classes-06.php';
require $srcDir . '/classes-16.php';
require $srcDir . '/classes-26.php';
require $srcDir . '/interfaces-06.php';
require $srcDir . '/interfaces-16.php';
require $srcDir . '/interfaces-26.php';

$classes = [
    A06::class,
    B06::class,
    C06::class,
    D06::class,
    E06::class,
    F06::class,
    A16::class,
    B16::class,
    C16::class,
    D16::class,
    E16::class,
    F16::class,
    G16::class,
    H16::class,
    I16::class,
    J16::class,
    K16::class,
    L16::class,
    M16::class,
    N16::class,
    O16::class,
    P16::class,
    A26::class,
    B26::class,
    C26::class,
    D26::class,
    E26::class,
    F26::class,
    G26::class,
    H26::class,
    I26::class,
    J26::class,
    K26::class,
    L26::class,
    M26::class,
    N26::class,
    O26::class,
    P26::class,
    Q26::class,
    R26::class,
    S26::class,
    T26::class,
    U26::class,
    V26::class,
    W26::class,
    X26::class,
    Y26::class,
    Z26::class,
];

$interfaces = [];
foreach ([['F', '06'], ['P', '16'], ['Z', '26']] as [$max, $suffix]) {
    foreach (range('A', $max) as $letter) {
        $iface = $letter . 'In' . $suffix;
        $impl = $letter . 'Im' . $suffix;
        $interfaces[$iface] = $impl;
    }
}

$module = new class ($classes, $interfaces) extends AbstractModule {
    /** @var array<int, string> */
    private array $classes;
    /** @var array<string, string> */
    private array $interfaces;
    public function __construct(array $classes, array $interfaces)
    {
        $this->classes = $classes;
        $this->interfaces = $interfaces;
        parent::__construct();
    }
    protected function configure(): void
    {
        foreach ($this->classes as $class) {
            $this->bind($class);
        }
        foreach ($this->interfaces as $iface => $impl) {
            $this->bind($iface)->to($impl);
        }
    }
};

$dir = __DIR__ . '/compiled';
(new Compiler())->compile($module, $dir);
