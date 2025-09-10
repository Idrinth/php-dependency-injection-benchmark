<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes-06.php';
require __DIR__ . '/classes-16.php';
require __DIR__ . '/classes-26.php';
require __DIR__ . '/interfaces-06.php';
require __DIR__ . '/interfaces-16.php';
require __DIR__ . '/interfaces-26.php';

$compiler = new Nette\DI\Compiler();
$compiler->setClassName('CompiledContainer');

$definitions = [
    F06::class => [E06::class, D06::class, B06::class],
    E06::class => [D06::class, C06::class, B06::class],
    D06::class => [C06::class, B06::class, A06::class],
    C06::class => [B06::class],
    B06::class => [A06::class],
    A06::class => [],
    P16::class => [O16::class, N16::class, M16::class],
    O16::class => [N16::class, M16::class],
    N16::class => [M16::class, L16::class, K16::class],
    M16::class => [L16::class, K16::class],
    L16::class => [K16::class],
    K16::class => [J16::class, I16::class, H16::class],
    J16::class => [I16::class, H16::class],
    I16::class => [H16::class, G16::class, F16::class],
    H16::class => [G16::class, F16::class],
    G16::class => [F16::class],
    F16::class => [E16::class, D16::class, B16::class],
    E16::class => [D16::class, C16::class],
    D16::class => [C16::class, B16::class, A16::class],
    C16::class => [B16::class],
    B16::class => [A16::class],
    A16::class => [],
    Z26::class => [Y26::class, X26::class, W26::class, V26::class, U26::class],
    Y26::class => [X26::class, W26::class, V26::class, U26::class],
    X26::class => [W26::class, V26::class, U26::class],
    W26::class => [V26::class, U26::class],
    V26::class => [U26::class],
    U26::class => [T26::class, S26::class, R26::class, Q26::class, P26::class],
    T26::class => [S26::class, R26::class, Q26::class, P26::class],
    S26::class => [R26::class, Q26::class, P26::class],
    R26::class => [Q26::class, P26::class],
    Q26::class => [P26::class, O26::class, N26::class, M26::class, L26::class],
    P26::class => [O26::class, N26::class, M26::class, L26::class],
    O26::class => [N26::class, M26::class, L26::class],
    N26::class => [M26::class, L26::class],
    M26::class => [L26::class, K26::class, J26::class, I26::class, H26::class],
    L26::class => [K26::class, J26::class, I26::class, H26::class, G26::class],
    K26::class => [J26::class, I26::class, H26::class, G26::class, F26::class],
    J26::class => [I26::class, H26::class, G26::class, F26::class],
    I26::class => [H26::class, G26::class, F26::class],
    H26::class => [G26::class, F26::class],
    G26::class => [F26::class],
    F26::class => [E26::class, D26::class, B26::class],
    E26::class => [D26::class, C26::class],
    D26::class => [C26::class, B26::class, A26::class],
    C26::class => [B26::class],
    B26::class => [A26::class],
    A26::class => [],
];

$services = [];
foreach ($definitions as $class => $deps) {
    $services[] = $class;
    $iface = substr($class, 0, 1) . 'In' . substr($class, 1);
    $impl = substr($class, 0, 1) . 'Im' . substr($class, 1);
    $services[$iface] = $impl;
}

$compiler->addConfig(['services' => $services]);
file_put_contents(__DIR__ . '/CompiledContainer.php', '<?php '.$compiler->compile());

