<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/AdapterImplementation.php';
require_once __DIR__.'/classes-06.php';

$adapter = new AdapterImplementation();
$iterations = 10000;
$runs = 10;
$times = [];
for ($j = 0; $j < $runs; $j++) {
    $start = microtime(true);
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(F06::class);
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
    $adapter = new AdapterImplementation();
    for ($i = 0; $i < $iterations; $i++) {
        $object = $adapter->get(F06::class);
        unset($object);
    }
    $time = microtime(true) - $start;
    $times[] = $time;
    echo "run $j: $time seconds per $iterations\n";
}

echo "\nAVERAGE | MINIMUM | MAXIMUM\n";
echo (array_sum($times)/count($times)) . " | " . min($times) . " | " . max($times) . "\n";

