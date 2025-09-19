<?php

declare(strict_types=1);

chdir(__DIR__ . '/..');

function parse_run_summary(string $filename): array
{
    $lines = file($filename);
    $containers = [];
    $values = [];
    $inResults = false;
    $currentContainer = null;
    $currentMetric = null;
    foreach ($lines as $line) {
        if (!$inResults) {
            if (str_starts_with($line, 'results:')) {
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

function indent(int $level): string {
    return str_repeat(' ', $level * 4);
}

function format_list(array $items, int $level): string {
    if ($items === []) {
        return indent($level) . "[]\n";
    }
    return implode('', array_map(fn($i) => indent($level) . "- $i\n", $items));
}

function build_job(string $name, array $containers): string {
    $yaml  = indent(1) . "$name:\n";
    $yaml .= indent(2) . "if: github.actor != 'github-actions[bot]'\n";
    $yaml .= indent(2) . "needs: download-php-cli\n";
    $yaml .= indent(2) . "runs-on: ubuntu-latest\n";
    $yaml .= indent(2) . "strategy:\n";
    $yaml .= indent(3) . "matrix:\n";
    $yaml .= indent(4) . "container:\n";
    $yaml .= format_list($containers, 5);
    $yaml .= indent(2) . "steps:\n";
    $yaml .= indent(3) . "- uses: actions/checkout@v5\n";
    $yaml .= indent(3) . "- name: Download PHP CLI image\n";
    $yaml .= indent(3) . "  uses: actions/download-artifact@v5\n";
    $yaml .= indent(3) . "  with:\n";
    $yaml .= indent(4) . "name: php-8.4-cli\n";
    $yaml .= indent(4) . "path: .\n";
    $yaml .= indent(3) . "- name: Load PHP CLI image\n";
    $yaml .= indent(3) . "  run: docker load -i php-8.4-cli.tar\n";
    $yaml .= indent(3) . "- name: Build container\n";
    $yaml .= indent(3) . "  run: |\n";
    $yaml .= indent(4) . '  docker build -t di-benchmark-${{ matrix.container }} -f containers/${{ matrix.container }}/Dockerfile .' . "\n";
    $yaml .= indent(4) . '  docker save di-benchmark-${{ matrix.container }} -o di-benchmark-${{ matrix.container }}.tar' . "\n";
    $yaml .= indent(3) . "- name: Upload image\n";
    $yaml .= indent(3) . "  uses: actions/upload-artifact@v4\n";
    $yaml .= indent(3) . "  with:\n";
    $yaml .= indent(4) . 'name: di-benchmark-${{ matrix.container }}' . "\n";
    $yaml .= indent(4) . 'path: di-benchmark-${{ matrix.container }}.tar' . "\n";
    return $yaml;
}

function benchmark_job(string $name, array $needs, array $containers, array $tests, array $runs, int $iterations): string {
    $yaml  = indent(1) . "$name:\n";
    $yaml .= indent(2) . "if: github.actor != 'github-actions[bot]'\n";
    if (count($needs) === 1) {
        $yaml .= indent(2) . 'needs: ' . $needs[0] . "\n";
    } else {
        $yaml .= indent(2) . "needs:\n";
        $yaml .= format_list($needs, 3);
    }
    $yaml .= indent(2) . "runs-on: ubuntu-latest\n";
    $yaml .= indent(2) . "strategy:\n";
    $yaml .= indent(3) . "matrix:\n";
    $yaml .= indent(4) . "container:\n";
    $yaml .= format_list($containers, 5);
    $yaml .= indent(4) . "test:\n";
    $yaml .= format_list($tests, 5);
    $yaml .= indent(4) . "run:\n";
    $yaml .= format_list($runs, 5);
    $yaml .= indent(2) . "steps:\n";
    $yaml .= indent(3) . "- uses: actions/checkout@v5\n";
    $yaml .= indent(3) . "- name: Download image\n";
    $yaml .= indent(3) . "  uses: actions/download-artifact@v5\n";
    $yaml .= indent(3) . "  with:\n";
    $yaml .= indent(4) . 'name: di-benchmark-${{ matrix.container }}' . "\n";
    $yaml .= indent(4) . "path: .\n";
    $yaml .= indent(3) . "- name: Load image\n";
    $yaml .= indent(3) . '  run: docker load -i di-benchmark-${{ matrix.container }}.tar' . "\n";
    $yaml .= indent(3) . "- name: Run benchmarks\n";
    $yaml .= indent(3) . "  run: |\n";
    $yaml .= indent(4) . '  docker run --rm --memory=512m --memory-swap=512m --cpus=1.0 --pids-limit=100 -v "$PWD:/out" di-benchmark-${{ matrix.container }} php benchmark.php ${{ matrix.test }} ' . $iterations . " 2>&1\n";
    $yaml .= indent(4) . '  mv results.json ${{ matrix.container }}-${{ matrix.test }}-${{ matrix.run }}.json' . "\n";
    $yaml .= indent(3) . "- name: Upload results\n";
    $yaml .= indent(3) . "  uses: actions/upload-artifact@v4\n";
    $yaml .= indent(3) . "  with:\n";
    $yaml .= indent(4) . 'name: result-${{ matrix.container }}-${{ matrix.test }}-${{ matrix.run }}' . "\n";
    $yaml .= indent(4) . 'path: ${{ matrix.container }}-${{ matrix.test }}-${{ matrix.run }}.json' . "\n";
    return $yaml;
}

function aggregate_job(): string {
    return <<<'YAML'
    aggregate:
        if: github.actor != 'github-actions[bot]'
        needs:
            - benchmark-fast-26
            - benchmark-fast-in-26
            - benchmark-medium-16
            - benchmark-medium-in-16
            - benchmark-slow-06
            - benchmark-slow-in-06
        permissions: write-all
        runs-on: ubuntu-latest
        steps:
            - uses: actions/checkout@v5
            - name: Download results
              uses: actions/download-artifact@v5
              with:
                pattern: 'result-*-*-*'
                merge-multiple: true
            - name: Merge test results
              run: php tools/merge_json.php
            - name: Generate graphs
              run: php tools/generate_graphs.php
            - name: Generate run summary
              run: php tools/generate_run_summary.php
            - name: Generate README
              run: php tools/generate_readme.php
            - name: Update workflow
              run: php tools/update_workflow.php
            - name: Commit results
              run: |
                git config --global user.name 'github-actions[bot]'
                git config --global user.email 'github-actions[bot]@users.noreply.github.com'
                git add README.md images/speed_comparison_*.jpg run_summary.yaml proposed-workflow.yml
                if [ "$GITHUB_EVENT_NAME" = "schedule" ]; then
                    git add archive
                fi
                git commit -m "Update test results" || echo "No changes to commit"
                git push
              env:
                GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
YAML;
}

function build_workflow(array $fast, array $medium, array $slow): string {
    $header = <<<'YAML'
---
name: Update test results

'on':
    workflow_dispatch:
    schedule:
        - cron: '0 0 1 * *'
    push:
        branches:
            - the-one
        paths:
            - '**/*.php'
            - '**/*.json'
            - '.github/workflows/update-test-results.yml'

concurrency:
    group: ${{ github.workflow }}-${{ github.ref }}
    cancel-in-progress: true

jobs:

YAML;

    $yaml = $header;
    $yaml .= indent(1) . "download-php-cli:\n";
    $yaml .= indent(2) . "runs-on: ubuntu-latest\n";
    $yaml .= indent(2) . "steps:\n";
    $yaml .= indent(3) . "- name: Pull PHP CLI image\n";
    $yaml .= indent(3) . "  run: docker pull php:8.4-cli\n";
    $yaml .= indent(3) . "- name: Save PHP CLI image\n";
    $yaml .= indent(3) . "  run: docker save php:8.4-cli -o php-8.4-cli.tar\n";
    $yaml .= indent(3) . "- name: Upload PHP CLI image\n";
    $yaml .= indent(3) . "  uses: actions/upload-artifact@v4\n";
    $yaml .= indent(3) . "  with:\n";
    $yaml .= indent(4) . "name: php-8.4-cli\n";
    $yaml .= indent(4) . "path: php-8.4-cli.tar\n";
    $yaml .= build_job('build-fast', $fast);
    $yaml .= build_job('build-medium', $medium);
    $yaml .= build_job('build-slow', $slow);

    $fastInterfaces = array_values(array_filter($fast, fn($c) => str_contains($c, '.configured.') || str_contains($c, '.compiled.')));
    $mediumInterfaces = array_values(array_filter($medium, fn($c) => str_contains($c, '.configured.') || str_contains($c, '.compiled.')));
    $slowInterfaces = array_values(array_filter($slow, fn($c) => str_contains($c, '.configured.') || str_contains($c, '.compiled.')));

    $benchmarks = [
        ['benchmark-fast-06', ['build-fast'], $fast, ['f06', 'f06_startup'], [1], 10],
        ['benchmark-fast-16', ['build-fast'], $fast, ['p16', 'p16_startup'], [1], 10],
        ['benchmark-fast-26', ['build-fast'], $fast, ['z26', 'z26_startup'], [1], 10],
        ['benchmark-fast-in-06', ['build-fast'], $fastInterfaces, ['fin06', 'fin06_startup'], [1], 10],
        ['benchmark-fast-in-16', ['build-fast'], $fastInterfaces, ['pin16', 'pin16_startup'], [1], 10],
        ['benchmark-fast-in-26', ['build-fast'], $fastInterfaces, ['zin26', 'zin26_startup'], [1], 10],
        ['benchmark-medium-06', ['build-medium', 'benchmark-fast-06'], $medium, ['f06', 'f06_startup'], [1, 2], 5],
        ['benchmark-medium-16', ['benchmark-fast-16', 'build-medium'], $medium, ['p16', 'p16_startup'], range(1, 10), 1],
        ['benchmark-medium-in-06', ['build-medium', 'benchmark-fast-in-06'], $mediumInterfaces, ['fin06', 'fin06_startup'], [1, 2], 5],
        ['benchmark-medium-in-16', ['benchmark-fast-in-16', 'build-medium'], $mediumInterfaces, ['pin16', 'pin16_startup'], range(1, 10), 1],
        ['benchmark-slow-06', ['benchmark-medium-06', 'build-slow'], $slow, ['f06', 'f06_startup'], range(1, 10), 1],
        ['benchmark-slow-in-06', ['benchmark-medium-in-06', 'build-slow'], $slowInterfaces, ['fin06', 'fin06_startup'], range(1, 10), 1],
    ];

    foreach ($benchmarks as [$name, $needs, $containers, $tests, $runs, $iterations]) {
        $yaml .= benchmark_job($name, $needs, $containers, $tests, $runs, $iterations);
    }

    $yaml .= aggregate_job();
    return $yaml;
}


[$containers, $summary] = parse_run_summary('run_summary.yaml');

$fast = [];
$medium = [];
$slow = [];

$metrics = ['f06', 'p16', 'z26'];
$scores = [];

foreach ($containers as $container) {
    if ($container === 'php-baseline') {
        $fast[] = $container;
        continue;
    }
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
    if ($container === 'php-baseline') {
        continue;
    }
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

$workflow = build_workflow($fast, $medium, $slow);
file_put_contents('proposed-workflow.yml', $workflow . "\n");
