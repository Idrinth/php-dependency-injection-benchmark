<?php
$files = glob('*.json');
sort($files);
$dirs = array_map(fn($f) => pathinfo($f, PATHINFO_FILENAME), $files);

$phpVersion = PHP_VERSION;
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

$tests = ['f06', 'f06_startup', 'p16', 'p16_startup', 'z26', 'z26_startup'];
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
