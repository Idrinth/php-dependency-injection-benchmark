<?php

declare(strict_types=1);

chdir(__DIR__ . '/..');

$files = glob('*.json');
sort($files);
$dirs = array_map(fn($f) => pathinfo($f, PATHINFO_FILENAME), $files);

// determine PHP version from container Dockerfiles
$phpVersion = 'unknown';
$dockerFiles = glob('containers/*/Dockerfile');
sort($dockerFiles);
foreach ($dockerFiles as $dockerFile) {
    $firstLine = trim(file($dockerFile)[0] ?? '');
    if (preg_match('/FROM\s+php:([^\s]+)/i', $firstLine, $matches)) {
        $phpVersion = str_replace('-cli', '', $matches[1]);
        break;
    }
}
$date = (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d');

$depVersions = [];
foreach ($dirs as $dir) {
    $compFile = "containers/{$dir}/composer.json";
    if (!file_exists($compFile)) {
        continue;
    }
    $compData = json_decode(file_get_contents($compFile), true);
    if (!is_array($compData['require'] ?? null)) {
        continue;
    }
    $firstDep = array_slice($compData['require'], 0, 1, true);
    foreach ($firstDep as $package => $version) {
        $depVersions[$dir][$package] = $version;
    }
}

$tests = [
    'f06',
    'f06_startup',
    'fin06',
    'fin06_startup',
    'p16',
    'p16_startup',
    'pin16',
    'pin16_startup',
    'z26',
    'z26_startup',
    'zin26',
    'zin26_startup',
];
$results = [];
foreach ($dirs as $dir) {
    $jsonFile = "{$dir}.json";
    if (!file_exists($jsonFile)) {
        continue;
    }
    $data = json_decode(file_get_contents($jsonFile), true);
    foreach ($tests as $test) {
        $avg = $data[$test]['average'] ?? 0;
        $min = $data[$test]['min'] ?? 0;
        $max = $data[$test]['max'] ?? 0;
        $results[$dir][$test] = [
            'average' => $avg,
            'minimum' => $min,
            'maximum' => $max,
        ];
    }
}

$lines = [];
$lines[] = 'php_version: "' . $phpVersion . '"';
$lines[] = 'dependency_versions:';
foreach ($depVersions as $dir => $deps) {
    $lines[] = '  ' . $dir . ':';
    foreach ($deps as $package => $version) {
        $lines[] = '    ' . $package . ': "' . $version . '"';
    }
}
$lines[] = 'results:';
foreach ($results as $dir => $testsData) {
    $lines[] = '  ' . $dir . ':';
    foreach ($testsData as $test => $stats) {
        $lines[] = '    ' . $test . ':';
        $lines[] = '      average: ' . $stats['average'];
        $lines[] = '      minimum: ' . $stats['minimum'];
        $lines[] = '      maximum: ' . $stats['maximum'];
    }
}
file_put_contents('run_summary.yaml', implode("\n", $lines) . "\n");

if (getenv('GITHUB_EVENT_NAME') === 'schedule') {
    if (!is_dir('archive')) {
        mkdir('archive', 0777, true);
    }
    copy('run_summary.yaml', 'archive/' . $date . '.yaml');
}
