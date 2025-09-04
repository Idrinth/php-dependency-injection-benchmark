<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/AdapterImplementation.php';
require_once __DIR__.'/classes-06.php';
require_once __DIR__.'/classes-26.php';

$iterations = 10000;
$runs = 10;

function runBenchmark(string $class, int $iterations, int $runs, bool $includeStartup): void {
    $label = $includeStartup ? 'including startup time' : 'without startup time';
    echo "=== Benchmark {$class} {$label} ===\n";
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
        $time = microtime(true) - $start;
        $times[] = $time;
        echo "run $j: $time seconds per $iterations\n";
    }

    echo "\nAVERAGE | MINIMUM | MAXIMUM\n";
    echo (array_sum($times)/count($times)) . " | " . min($times) . " | " . max($times) . "\n\n";
}

$tests = [
    'f06' => [F06::class, false],
    'f06_startup' => [F06::class, true],
    'z26' => [Z26::class, false],
    'z26_startup' => [Z26::class, true],
];

$selected = $argv[1] ?? null;

if ($selected === null) {
    foreach ($tests as [$class, $startup]) {
        runBenchmark($class, $iterations, $runs, $startup);
    }
} elseif (isset($tests[$selected])) {
    [$class, $startup] = $tests[$selected];
    runBenchmark($class, $iterations, $runs, $startup);
} else {
    $available = implode(', ', array_keys($tests));
    echo "Unknown test '{$selected}'. Available tests: {$available}\n";
    exit(1);
}

