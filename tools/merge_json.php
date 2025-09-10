<?php

chdir(__DIR__ . '/..');

function merge_json_files(array $files): array
{
    $merged = [];
    foreach ($files as $file) {
        if (!file_exists($file)) {
            continue;
        }
        $contents = file_get_contents($file);
        $data = json_decode($contents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            fwrite(STDERR, "Warning: Error decoding {$file}: " . json_last_error_msg() . "\n");
            continue;
        }
        if (!is_array($data)) {
            fwrite(STDERR, "Warning: JSON in {$file} does not decode to array\n");
            continue;
        }
        foreach ($data as $test => $result) {
            if (!isset($merged[$test])) {
                $merged[$test] = $result;
                continue;
            }
            if (!isset($result['runs']) || !is_array($result['runs'])) {
                fwrite(STDERR, "Warning: Missing runs array for {$test} in {$file}\n");
                continue;
            }
            $merged[$test]['runs'] = array_merge($merged[$test]['runs'], $result['runs']);
        }
    }
    foreach ($merged as $test => &$result) {
        if (isset($result['runs']) && is_array($result['runs'])) {
            $runs = $result['runs'];
            $result['average'] = array_sum($runs) / count($runs);
            $result['min'] = min($runs);
            $result['max'] = max($runs);
        }
    }
    unset($result);
    return $merged;
}

if ($argc > 2) {
    $output = $argv[1];
    $inputs = array_slice($argv, 2);
    $merged = merge_json_files($inputs);
    file_put_contents($output, json_encode($merged, JSON_PRETTY_PRINT));
    return;
}

$runFiles = glob('*-*-*.json');
if (!$runFiles) {
    return;
}

$containers = [];
foreach ($runFiles as $file) {
    if (!preg_match('/^(.+)-([^-]+)-[^-]+\.json$/', $file, $matches)) {
        continue;
    }
    $container = $matches[1];
    $test = $matches[2];
    $containers[$container][$test][] = $file;
}

foreach ($containers as $container => $tests) {
    foreach ($tests as $test => $files) {
        $merged = merge_json_files($files);
        file_put_contents("{$container}-{$test}.json", json_encode($merged, JSON_PRETTY_PRINT));
        foreach ($files as $f) {
            unlink($f);
        }
    }
    $testFiles = glob("{$container}-*.json");
    $mergedContainer = merge_json_files($testFiles);
    file_put_contents("{$container}.json", json_encode($mergedContainer, JSON_PRETTY_PRINT));
    foreach ($testFiles as $f) {
        unlink($f);
    }
}
