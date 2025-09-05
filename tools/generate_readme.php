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

$data = parse_simple_yaml('run_summary.yaml');

$lines = [];
$lines[] = '# PHP Dependency Injection Benchmark';
$lines[] = '';
$lines[] = 'This repository benchmarks different dependency injection containers.';
$lines[] = '';
if (!empty($data['php_version'])) {
    $lines[] = 'Tested with PHP ' . $data['php_version'] . '.';
    $lines[] = '';
}
$depVersions = $data['dependency_versions'] ?? [];
if ($depVersions) {
    $lines[] = '## Dependency Versions';
    $lines[] = '';
    foreach ($depVersions as $container => $deps) {
        $lines[] = '- **' . format_name($container) . '**';
        foreach ($deps as $dep => $version) {
            $lines[] = '  - `' . $dep . '`: `' . $version . '`';
        }
        $lines[] = '';
    }
}
$results = $data['results'] ?? [];
if ($results) {
    $lines[] = '## Summary';
    $lines[] = '';
    $lines[] = '| Container | Average | Minimum | Maximum |';
    $lines[] = '| --- | --- | --- | --- |';
    foreach ($results as $container => $stats) {
        $lines[] = sprintf('| %s | %s | %s | %s |',
            format_name($container),
            $stats['average'],
            $stats['minimum'],
            $stats['maximum']
        );
    }
    $lines[] = '';
}
foreach (['06', '16', '26'] as $num) {
    $lines[] = "![Speed comparison without startup time](speed_comparison_without_startup$num.png)";
    $lines[] = '';
    $lines[] = "![Speed comparison with startup time](speed_comparison_with_startup$num.png)";
    $lines[] = '';
}
file_put_contents('README.md', implode("\n", $lines));
