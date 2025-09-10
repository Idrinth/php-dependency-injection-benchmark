<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/AdapterImplementation.php';
require_once __DIR__ . '/classes-06.php';
require_once __DIR__ . '/classes-16.php';
require_once __DIR__ . '/classes-26.php';
require_once __DIR__ . '/interfaces-06.php';
require_once __DIR__ . '/interfaces-16.php';
require_once __DIR__ . '/interfaces-26.php';

$iterations = 10000;
$runs = (int)($argv[2] ?? 10);

function runBenchmark(string $class, int $iterations, int $runs, bool $includeStartup): array
{
    $times = [];

    if (!$includeStartup) {
        $adapter = new AdapterImplementation();
    }

    for ($j = 0; $j < $runs; $j++) {
        $start = microtime(true);
        if ($includeStartup) {
            $adapter = new AdapterImplementation();
        }
        for ($i = 0; $i < $iterations; $i++) {
            $object = $adapter->get($class);
            unset($object);
        }
        $times[] = microtime(true) - $start;
        fwrite(STDERR, '.');
    }

    fwrite(STDERR, ' ' . $j . '/' . $runs . PHP_EOL);

    return [
        'class' => $class,
        'include_startup' => $includeStartup,
        'runs' => $times,
        'average' => array_sum($times) / count($times),
        'min' => min($times),
        'max' => max($times),
    ];
}

$tests = [
    'f06' => [F06::class, false],
    'f06_startup' => [F06::class, true],
    'fin06' => [FIn06::class, false],
    'fin06_startup' => [FIn06::class, true],
    'p16' => [P16::class, false],
    'p16_startup' => [P16::class, true],
    'pin16' => [PIn16::class, false],
    'pin16_startup' => [PIn16::class, true],
    'z26' => [Z26::class, false],
    'z26_startup' => [Z26::class, true],
    'zin26' => [ZIn26::class, false],
    'zin26_startup' => [ZIn26::class, true],
];

$selected = $argv[1] ?? null;
$results = [];

if ($selected === null) {
    foreach ($tests as $name => [$class, $startup]) {
        fwrite(STDERR, 'Running ' . $name . ': ');
        $results[$name] = runBenchmark($class, $iterations, $runs, $startup);
    }
} elseif (isset($tests[$selected])) {
    [$class, $startup] = $tests[$selected];
    fwrite(STDERR, 'Running ' . $selected . ': ');
    $results[$selected] = runBenchmark($class, $iterations, $runs, $startup);
} else {
    $available = implode(', ', array_keys($tests));
    echo json_encode(['error' => "Unknown test '{$selected}'. Available tests: {$available}"]) . PHP_EOL;
    exit(1);
}

$outputDir = '/out';
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}
$file = $outputDir . '/results.json';
file_put_contents($file, json_encode($results, JSON_PRETTY_PRINT) . PHP_EOL);
fwrite(STDERR, 'Results written to ' . $file . PHP_EOL);
