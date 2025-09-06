<?php

chdir(__DIR__ . '/..');

function parse_simple_yaml(string $filename): array {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $data = [];
    $indentStack = [0];
    $refStack = [&$data];
    foreach ($lines as $rawLine) {
        if (preg_match('/^\s*#/', $rawLine)) {
            continue;
        }
        if (!preg_match('/^(\s*)([^:]+):(?:\s*(.*))?$/', $rawLine, $matches)) {
            continue;
        }
        $indent = strlen($matches[1]);
        $key = rtrim($matches[2]);
        $valuePart = isset($matches[3]) ? trim($matches[3]) : '';
        while ($indent < end($indentStack)) {
            array_pop($indentStack);
            array_pop($refStack);
        }
        if ($valuePart === '' || $valuePart === null) {
            $refStack[count($refStack)-1][$key] = [];
            $refStack[] = &$refStack[count($refStack)-1][$key];
            $indentStack[] = $indent + 2;
        } else {
            $value = trim($valuePart, "'\"");
            if (is_numeric($value)) {
                $value = strpos($value, '.') !== false ? (float)$value : (int)$value;
            }
            $refStack[count($refStack)-1][$key] = $value;
        }
    }
    return $data;
}

function format_name(string $name): string {
    if (strpos($name, '.') !== false) {
        [$first, $rest] = explode('.', $name, 2);
        return $first . '(' . $rest . ')';
    }
    return $name;
}

function format_time(float $seconds): string {
    $totalNs = (int) round($seconds * 1000000000);
    $s = intdiv($totalNs, 1000000000);
    $ms = intdiv($totalNs % 1000000000, 1000000);
    $ns = $totalNs % 1000;
    $parts = [];
    if ($s > 0) {
        $parts[] = $s . 's';
    }
    if ($ms > 0 || $s > 0) {
        $parts[] = $ms . 'ms';
    }
    $parts[] = $ns . 'ns';
    return implode(' ', $parts);
}

$data = parse_simple_yaml('run_summary.yaml');

$lines = [];
$lines[] = '# PHP Dependency Injection Benchmark';
$lines[] = '';
$lines[] = 'This repository benchmarks different dependency injection containers.';
$lines[] = '';
$depVersions = $data['dependency_versions'] ?? [];
if (!empty($data['php_version'])) {
    $lines[] = '## Environment';
    $lines[] = '';
    $lines[] = '| Component | Version |';
    $lines[] = '| --- | --- |';
    $lines[] = '| PHP | ' . $data['php_version'] . ' |';
    $lines[] = '';
}
$results = $data['results'] ?? [];
$tests = [
    'f06' => ['title' => 'f06', 'image' => 'images/speed_comparison_without_startup06.jpg'],
    'f06_startup' => ['title' => 'f06 startup', 'image' => 'images/speed_comparison_with_startup06.jpg'],
    'p16' => ['title' => 'p16', 'image' => 'images/speed_comparison_without_startup16.jpg'],
    'p16_startup' => ['title' => 'p16 startup', 'image' => 'images/speed_comparison_with_startup16.jpg'],
    'z26' => ['title' => 'z26', 'image' => 'images/speed_comparison_without_startup26.jpg'],
    'z26_startup' => ['title' => 'z26 startup', 'image' => 'images/speed_comparison_with_startup26.jpg'],
];
foreach ($tests as $testKey => $info) {
    $lines[] = '## ' . $info['title'];
    $lines[] = '';
    $lines[] = '| Container | Version | Average | Minimum | Maximum |';
    $lines[] = '| --- | --- | --- | --- | --- |';
    foreach ($results as $container => $stats) {
        if (!isset($stats[$testKey])) {
            continue;
        }
        $t = $stats[$testKey];
        if ($t['average'] == 0 && $t['minimum'] == 0 && $t['maximum'] == 0) {
            continue;
        }
        $version = '';
        if (isset($depVersions[$container])) {
            $version = reset($depVersions[$container]);
        }
        $lines[] = sprintf(
            '| %s | %s | %s | %s | %s |',
            format_name($container),
            $version,
            format_time($t['average']),
            format_time($t['minimum']),
            format_time($t['maximum'])
        );
    }
    $lines[] = '';
    $lines[] = '![' . $info['title'] . '](' . $info['image'] . ')';
    $lines[] = '';
}
file_put_contents('README.md', implode("\n", $lines));
