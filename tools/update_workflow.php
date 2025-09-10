<?php

chdir(__DIR__ . '/..');

function parse_run_summary(string $filename): array {
    $lines = file($filename);
    $containers = [];
    $values = [];
    $inResults = false;
    $currentContainer = null;
    $currentMetric = null;
    foreach ($lines as $line) {
        if (!$inResults) {
            if (preg_match('/^results:/', $line)) {
                $inResults = true;
            }
            continue;
        }
        if (preg_match('/^\s{2}([a-z0-9\.\-]+):\s*$/i', $line, $m)) {
            $currentContainer = $m[1];
            $containers[] = $currentContainer;
            continue;
        }
        if (preg_match('/^\s{4}([a-z0-9_]+):\s*$/i', $line, $m)) {
            $currentMetric = $m[1];
            continue;
        }
        if (preg_match('/^\s{6}average:\s*([0-9\.]+)/i', $line, $m)) {
            $values[$currentContainer][$currentMetric] = (float) $m[1];
        }
    }
    return [$containers, $values];
}

function replace_container_list(string $workflow, string $job, array $containers): string {
    $pattern = '/(^    ' . preg_quote($job, '/') . ":\n[\s\S]*?container:\n)(?: {20}- .*?\n| {20}\[\]\n)+/m";
    if ($containers === []) {
        $replacement = "$1                    []\n";
    } else {
        $replacement = "$1" . implode('', array_map(fn($c) => "                    - $c\n", $containers));
    }
    return preg_replace($pattern, $replacement, $workflow);
}

[$containers, $summary] = parse_run_summary('run_summary.yaml');

$fast = [];
$medium = [];
$slow = [];

$metrics = ['f06', 'p16', 'z26'];
$scores = [];

foreach ($containers as $container) {
    $maxValue = null;
    foreach ($metrics as $metric) {
        $value = $summary[$container][$metric] ?? null;
        if ($value !== null && $value > 0) {
            $maxValue = $maxValue === null ? $value : max($maxValue, $value);
        }
    }
    if ($maxValue === null) {
        $slow[] = $container;
    } else {
        $scores[$container] = $maxValue;
    }
}

$sortedScores = $scores;
asort($sortedScores);
$values = array_values($sortedScores);
$count = count($values);
$fastThreshold = $values[(int) floor($count / 3)] ?? 0;
$mediumThreshold = $values[(int) floor(2 * $count / 3)] ?? 0;

foreach ($containers as $container) {
    $score = $scores[$container] ?? null;
    if ($score === null) {
        continue;
    }
    if ($score <= $fastThreshold) {
        $fast[] = $container;
    } elseif ($score <= $mediumThreshold) {
        $medium[] = $container;
    } else {
        $slow[] = $container;
    }
}

$workflowFile = '.github/workflows/update-test-results.yml';
$workflow = file_get_contents($workflowFile);

$workflow = replace_container_list($workflow, 'build-fast', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-06', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-16', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-26', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-in-06', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-in-16', $fast);
$workflow = replace_container_list($workflow, 'benchmark-fast-in-26', $fast);

$workflow = replace_container_list($workflow, 'build-medium', $medium);
$workflow = replace_container_list($workflow, 'benchmark-medium-06', $medium);
$workflow = replace_container_list($workflow, 'benchmark-medium-16', $medium);
$workflow = replace_container_list($workflow, 'benchmark-medium-in-06', $medium);
$workflow = replace_container_list($workflow, 'benchmark-medium-in-16', $medium);

$workflow = replace_container_list($workflow, 'build-slow', $slow);
$workflow = replace_container_list($workflow, 'benchmark-slow-06', $slow);
$workflow = replace_container_list($workflow, 'benchmark-slow-in-06', $slow);

file_put_contents('proposed-workflow.yml', $workflow);
