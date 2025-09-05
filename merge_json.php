<?php
function merge_json_files(array $files): array {
    $merged = [];
    foreach ($files as $file) {
        if (!file_exists($file)) {
            continue;
        }
        $contents = file_get_contents($file);
        $data = json_decode($contents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("Error decoding {$file}: " . json_last_error_msg());
        }
        if (!is_array($data)) {
            throw new RuntimeException("JSON in {$file} does not decode to array");
        }
        foreach ($data as $test => $result) {
            if (!isset($merged[$test])) {
                $merged[$test] = $result;
                continue;
            }
            if (!isset($result['runs']) || !is_array($result['runs'])) {
                throw new RuntimeException("Missing runs array for {$test} in {$file}");
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

if ($argc < 3) {
    fwrite(STDERR, "Usage: php merge_json.php output.json input1.json [input2.json ...]\n");
    exit(1);
}

$output = $argv[1];
$inputs = array_slice($argv, 2);

$merged = merge_json_files($inputs);
file_put_contents($output, json_encode($merged, JSON_PRETTY_PRINT));

