<?php

chdir(__DIR__ . '/..');

function parse_simple_yaml(string $filename): array
{
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
        if ($valuePart === '') {
            $refStack[count($refStack) - 1][$key] = [];
            $refStack[] = &$refStack[count($refStack) - 1][$key];
            $indentStack[] = $indent + 2;
        } else {
            $value = trim($valuePart, "'\"");
            if (is_numeric($value)) {
                $value = str_contains($value, '.') ? (float)$value : (int)$value;
            }
            $refStack[count($refStack) - 1][$key] = $value;
        }
    }
    return $data;
}

function format_name(string $name): string
{
    $parts = explode('.', $name);
    $first = ucfirst(array_shift($parts));
    if (empty($parts)) {
        return $first;
    }
    $formatted = array_map(fn($p) => ucfirst($p), $parts);
    return $first . '(' . implode(', ', $formatted) . ')';
}

function format_time(float $seconds): string
{
    if ($seconds === 0.0) {
        return '-';
    }
    $s = (int) floor($seconds);
    $ms = ((int) floor($seconds * 1000)) % 1000;
    $us = ((int) floor($seconds * 1000000)) % 1000;
    $ns = ((int) floor($seconds * 1000000000)) % 1000;
    $parts = [];
    if ($s > 0) {
        $parts[] = $s . 's';
    }
    if ($ms > 0) {
        $parts[] = $ms . 'ms';
    }
    if ($us > 0) {
        $parts[] = $us . 'µs';
    }
    if ($ns > 0) {
        $parts[] = $ns . 'ns';
    }
    if (count($parts) > 0) {
        return implode(', ', $parts);
    }
    return '-';
}

$data = parse_simple_yaml('run_summary.yaml');

$phpBadge = '![PHP Version](https://img.shields.io/badge/PHP-' . rawurlencode($data['php_version']) . '-blue?logo=php)';
$dockerBadge = '![Docker Version](https://img.shields.io/badge/Docker-' . rawurlencode($data['docker_version'] ?? '*') . '-lightgrey?logo=docker)';
$osBadge = '![OS](https://img.shields.io/badge/OS-' . rawurlencode($data['os'] ?? 'ubuntu latest') . '-blue?logo=ubuntu)';
$memoryBadge = '![Memory](https://img.shields.io/badge/Memory-500MB-blue)';
$cpuBadge = '![CPU](https://img.shields.io/badge/CPU-1%20Core-blue)';

$lines = [];
$lines[] = '# PHP Dependency Injection Benchmark';
$lines[] = '';
$lines[] = $phpBadge . ' ' . $dockerBadge . ' ' . $osBadge;
$lines[] = '';
$lines[] = $memoryBadge . ' ' . $cpuBadge;
$lines[] = '';
$lines[] = '![PHP Dependency Injection Benchmark](images/php-dependency-injection-benchmark.jpg)';
$lines[] = '';
$lines[] = 'Dependency injection (DI) containers manage the creation and wiring of object dependencies, allowing applications to remain decoupled and easier to maintain.';
$lines[] = 'Testing these containers verifies that they resolve dependencies correctly and perform efficiently, which is vital for application reliability.';
$lines[] = '';
$lines[] = 'This repository benchmarks different dependency injection containers.';
$lines[] = '';
$lines[] = '**The "quickly" container is maintained by the same author as this benchmark, and the results may be unconsciously biased.**';
$lines[] = '';
$lines[] = 'To reduce favoritism, results are averaged over multiple runs and, where possible, multiple configurations of each container are benchmarked.';
$lines[] = '';
$lines[] = 'Detailed benchmark data, including environment details and dependency versions, is available in [`run_summary.yaml`](run_summary.yaml).';
$lines[] = 'Raw outputs for each monthly run are archived under the [`archive`](archive) directory with date-based subdirectories.';
$lines[] = '';
$lines[] = '## 📂 Test Files';
$lines[] = '';
$lines[] = 'The benchmark defines three dependency graphs used for testing.';
$lines[] = '';
$lines[] = '- `src/classes-06.php` (`f06`): 6 classes.';
$lines[] = '- `src/classes-16.php` (`p16`): 16 classes.';
$lines[] = '- `src/classes-26.php` (`z26`): 26 classes.';
$lines[] = '';
$lines[] = 'The class names (`f06`, `p16`, `z26`) follow a group-unique letter plus total class count in the group to avoid overlap.';
$lines[] = '';
$lines[] = 'Each file contains all required classes and avoids autoloading so that container performance measurements exclude file-loading overhead.';
$lines[] = 'Each test is executed with and without container startup time to measure resolution speed and initialization cost.';
$lines[] = '';
$depVersions = $data['dependency_versions'] ?? [];
$lines[] = '## 🚀 Running individual benchmarks';
$lines[] = '';
$lines[] = 'Build the container and execute a benchmark using docker:';
$lines[] = '';
$lines[] = '```sh';
$lines[] = 'docker build -t di-benchmark-php-di -f containers/php-di/Dockerfile .';
$lines[] = 'docker run --rm -v "$PWD:/out" di-benchmark-php-di php benchmark.php f06 1';
$lines[] = '```';
$lines[] = '';
$lines[] = 'The build step prepares the image for the chosen container, and the run command executes a single run of the specified test (for example, `f06`). The resulting `results.json` file will be written to the current directory.';
$lines[] = '';
$lines[] = 'Some containers perform extra work during the image build; for example, `ray-di.compiled` precompiles its dependencies automatically.';
$lines[] = '';
$containerTable = [
    'aura-di' => [
        'name' => 'Aura.Di',
        'url' => 'https://github.com/auraphp/Aura.Di',
        'features' => 'Configurable DI container with lazy loading and service factories',
    ],
    'php-di' => [
        'name' => 'PHP-DI',
        'url' => 'https://github.com/PHP-DI/PHP-DI',
        'features' => 'Autowiring, annotations, and compiled container support',
    ],
    'pimple' => [
        'name' => 'Pimple',
        'url' => 'https://github.com/silexphp/Pimple',
        'features' => 'Lightweight closure-based container',
    ],
    'symfony' => [
        'name' => 'Symfony DI',
        'url' => 'https://github.com/symfony/dependency-injection',
        'features' => 'Feature-rich container with configuration and compilation',
    ],
    'laravel' => [
        'name' => 'Laravel Container',
        'url' => 'https://github.com/laravel/framework',
        'features' => 'Framework-integrated container with automatic resolution and binding',
    ],
    'nette-di' => [
        'name' => 'Nette DI',
        'url' => 'https://github.com/nette/di',
        'features' => 'High-performance compiled container',
    ],
    'auryn' => [
        'name' => 'Auryn',
        'url' => 'https://github.com/rdlowrey/auryn',
        'features' => 'Auryn is a dependency injector for bootstrapping object-oriented PHP applications.',
    ],
    'dice' => [
        'name' => 'Dice',
        'url' => 'https://github.com/Level-2/Dice',
        'features' => 'A minimalist dependency injection container for PHP.',
    ],
    'laminas-servicemanager' => [
        'name' => 'Laminas ServiceManager',
        'url' => 'https://github.com/laminas/laminas-servicemanager',
        'features' => 'Factory-driven dependency injection container',
    ],
    'league' => [
        'name' => 'League Container',
        'url' => 'https://github.com/thephpleague/container',
        'features' => 'A fast and intuitive dependency injection container.',
    ],
    'phalcon' => [
        'name' => 'Phalcon',
        'url' => 'https://github.com/phalcon/cphalcon',
        'features' => 'A PHP extension built for performance',
    ],
    'php-baseline' => [
        'name' => 'PHP (baseline)',
        'url' => 'https://www.php.net/',
        'features' => 'Manual instantiation of dependencies with simple caching',
    ],
    'quickly' => [
        'name' => 'Quickly',
        'url' => 'https://github.com/Idrinth/quickly',
        'features' => 'A fast dependency injection container featuring build time resolution.',
    ],
    'ray-di' => [
        'name' => 'Ray.Di',
        'url' => 'https://github.com/ray-di/Ray.Di',
        'features' => 'DI and AOP framework for PHP inspired by Google Guice',
    ],
    'zen' => [
        'name' => 'Zen',
        'url' => 'https://github.com/woohoolabs/zen',
        'features' => 'Woohoo Labs. Zen DI Container and preload file generator',
    ],
];
$detected = trim(`find containers -mindepth 1 -maxdepth 1 -type d -printf '%f\n' | sed -E 's|\..*||; s|-container$||' | sort -u`);
if ($detected !== '') {
    foreach (explode("\n", $detected) as $c) {
        if (!isset($containerTable[$c])) {
            $containerTable[$c] = [
                'name' => ucwords(str_replace('-', ' ', $c)),
                'url' => '',
                'features' => '',
            ];
        }
    }
}
$containerRuns = [];
foreach (array_keys($data['results'] ?? []) as $containerName) {
    $parts = explode('.', $containerName);
    $base = array_shift($parts);
    if (!isset($containerRuns[$base])) {
        $containerRuns[$base] = [];
    }
    if (count($parts) >= 2) {
        $combo = $parts[0] . ' ' . $parts[1];
    } elseif (count($parts) === 1) {
        $combo = $parts[0];
    } else {
        $combo = '';
    }
    if ($combo !== '' && !in_array($combo, $containerRuns[$base], true)) {
        $containerRuns[$base][] = $combo;
    }
}
foreach ($containerRuns as &$runs) {
    sort($runs);
}
unset($runs);
$lines[] = '## 🧩 Containers';
$lines[] = '';
$lines[] = '| Name+Link | Run combinations | Description |';
$lines[] = '| --- | --- | --- |';
foreach ($containerTable as $key => $info) {
    $name = $info['name'];
    if ($info['url'] !== '') {
        $name = '[' . $name . '](' . $info['url'] . ')';
    }
    $runText = isset($containerRuns[$key]) ? implode(', ', $containerRuns[$key]) : '';
    $lines[] = '| ' . $name . ' | ' . $runText . ' | ' . $info['features'] . ' |';
}
$lines[] = '## Latest Results';
$lines[] = '';
$lines[] = 'Run from ' . date('Y-m-d');
$lines[] = '';
$results = $data['results'] ?? [];
$tests = [
    'f06' => [
        'title' => '📊 f06',
        'image' => 'images/speed_comparison_without_startup_f06.jpg',
        'description' => 'Small dependency graph including 6 classes total (excluding container startup time)'
    ],
    'f06_startup' => [
        'title' => '🚀 f06 startup',
        'image' => 'images/speed_comparison_with_startup_f06.jpg',
        'description' => 'Small dependency graph including 6 classes total (includes container startup time)'
    ],
    'fin06' => [
        'title' => '📊 fin06',
        'image' => 'images/speed_comparison_interfaces_without_startup06.jpg',
        'description' => 'Small interface-based dependency graph including 6 interfaces total (excluding container startup time)'
    ],
    'fin06_startup' => [
        'title' => '🚀 fin06 startup',
        'image' => 'images/speed_comparison_interfaces_with_startup06.jpg',
        'description' => 'Small interface-based dependency graph including 6 interfaces total (includes container startup time)'
    ],
    'p16' => [
        'title' => '📊 p16',
        'image' => 'images/speed_comparison_without_startup_p16.jpg',
        'description' => 'Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)'
    ],
    'p16_startup' => [
        'title' => '🚀 p16 startup',
        'image' => 'images/speed_comparison_with_startup_p16.jpg',
        'description' => 'Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)'
    ],
    'pin16' => [
        'title' => '📊 pin16',
        'image' => 'images/speed_comparison_interfaces_without_startup16.jpg',
        'description' => 'Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)'
    ],
    'pin16_startup' => [
        'title' => '🚀 pin16 startup',
        'image' => 'images/speed_comparison_interfaces_with_startup16.jpg',
        'description' => 'Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)'
    ],
    'z26' => [
        'title' => '📊 z26',
        'image' => 'images/speed_comparison_without_startup_z26.jpg',
        'description' => 'Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)'
    ],
    'z26_startup' => [
        'title' => '🚀 z26 startup',
        'image' => 'images/speed_comparison_with_startup_z26.jpg',
        'description' => 'Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)'
    ],
    'zin26' => [
        'title' => '📊 zin26',
        'image' => 'images/speed_comparison_interfaces_without_startup26.jpg',
        'description' => 'Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)'
    ],
    'zin26_startup' => [
        'title' => '🚀 zin26 startup',
        'image' => 'images/speed_comparison_interfaces_with_startup26.jpg',
        'description' => 'Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)'
    ],
];
foreach ($tests as $testKey => $info) {
    $lines[] = '### ' . $info['title'];
    if (!empty($info['description'])) {
        $lines[] = '';
        $lines[] = $info['description'];
    }
    $lines[] = '';
    $lines[] = '![' . $info['title'] . '](' . $info['image'] . ')';
    $lines[] = '';
    $lines[] = '<details>';
    $lines[] = '<summary>View results</summary>';
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
    $lines[] = '</details>';
    $lines[] = '';
}
$lines[] = 'Questions, issues, and new containers are welcome!';
$lines[] = '';
file_put_contents('README.md', implode("\n", $lines));
