<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/AdapterImplementation.php';
require_once __DIR__.'/classes-06.php';
require_once __DIR__.'/classes-26.php';

$iterations = 10000;
$runs = 10;

function runBenchmark(string $class, int $iterations, int $runs, bool $includeStartup): array {
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
    }

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
    'z26' => [Z26::class, false],
    'z26_startup' => [Z26::class, true],
];

$selected = $argv[1] ?? null;
$results = [];

if ($selected === null) {
    foreach ($tests as $name => [$class, $startup]) {
        $results[$name] = runBenchmark($class, $iterations, $runs, $startup);
    }
} elseif (isset($tests[$selected])) {
    [$class, $startup] = $tests[$selected];
    $results[$selected] = runBenchmark($class, $iterations, $runs, $startup);
} else {
    $available = implode(', ', array_keys($tests));
    echo json_encode(['error' => "Unknown test '{$selected}'. Available tests: {$available}"]) . PHP_EOL;
    exit(1);
}

echo json_encode($results, JSON_PRETTY_PRINT) . PHP_EOL;

