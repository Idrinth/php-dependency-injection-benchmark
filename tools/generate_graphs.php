<?php

chdir(__DIR__ . '/..');

function format_name(string $name): string
{
    if (strpos($name, '.') !== false) {
        [$first, $rest] = explode('.', $name, 2);
        return $first . "\n(" . $rest . ")";
    }
    return $name;
}

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

[$containers, $summary] = parse_run_summary('run_summary.yaml');
if (!$containers) {
    throw new RuntimeException('No benchmark data found in run_summary.yaml');
}
$displayNames = array_map('format_name', $containers);

function nice_number(float $value): float
{
    $exponent = floor(log10($value));
    $fraction = $value / pow(10, $exponent);
    if ($fraction <= 1) {
        $niceFraction = 1;
    } elseif ($fraction <= 2) {
        $niceFraction = 2;
    } elseif ($fraction <= 5) {
        $niceFraction = 5;
    } else {
        $niceFraction = 10;
    }
    return $niceFraction * pow(10, $exponent);
}

$withoutStartup06 = [];
$withStartup06 = [];
$withoutStartup06Interfaces = [];
$withStartup06Interfaces = [];
$withoutStartup26 = [];
$withStartup26 = [];
$withoutStartup26Interfaces = [];
$withStartup26Interfaces = [];
$withoutStartup16 = [];
$withStartup16 = [];
$withoutStartup16Interfaces = [];
$withStartup16Interfaces = [];
foreach ($containers as $container) {
    $values = $summary[$container] ?? [];
    $withoutStartup06[] = $values['f06'] ?? null;
    $withStartup06[] = $values['f06_startup'] ?? null;
    $withoutStartup06Interfaces[] = $values['fin06'] ?? null;
    $withStartup06Interfaces[] = $values['fin06_startup'] ?? null;
    $withoutStartup26[] = $values['z26'] ?? null;
    $withStartup26[] = $values['z26_startup'] ?? null;
    $withoutStartup26Interfaces[] = $values['zin26'] ?? null;
    $withStartup26Interfaces[] = $values['zin26_startup'] ?? null;
    $withoutStartup16[] = $values['p16'] ?? null;
    $withStartup16[] = $values['p16_startup'] ?? null;
    $withoutStartup16Interfaces[] = $values['pin16'] ?? null;
    $withStartup16Interfaces[] = $values['pin16_startup'] ?? null;
}

function create_bar_chart(array $values, string $title, string $filename, array $labels): void
{
    $count = count($values);
    $barHeight = 40;
    $spacing = 20;
    $leftMargin = 200;
    $rightMargin = 60;
    $topMargin = 40;
    $bottomMargin = 60;
    $plotWidth = 800;
    $plotHeight = $count * ($barHeight + $spacing) + $spacing;
    $width = $leftMargin + $plotWidth + $rightMargin;
    $height = $topMargin + $plotHeight + $bottomMargin;

    $img = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorallocate($img, 0, 0, 0);
    $blue = imagecolorallocate($img, 70, 130, 180);
    imagefill($img, 0, 0, $white);

    $titleFont = 5;
    $fontWidth = imagefontwidth($titleFont);
    $titleWidth = $fontWidth * strlen($title);
    imagestring($img, $titleFont, (int) max(0, ($width - $titleWidth) / 2), 5, $title, $black);
    $axisLabel = 'Seconds per 10,000';
    $axisLabelWidth = imagefontwidth(3) * strlen($axisLabel);
    imagestring(
        $img,
        3,
        (int) max(0, $leftMargin + ($plotWidth - $axisLabelWidth) / 2),
        $height - $bottomMargin + 20,
        $axisLabel,
        $black
    );

    $validLogs = array_filter($values, fn($v) => $v !== null);
    $maxLog = $validLogs ? max($validLogs) : 0;
    $tickStep = 0;
    $maxTick = $maxLog;
    if ($maxLog > 0) {
        $tickStep = nice_number($maxLog / 5);
        $maxTick = ceil($maxLog / $tickStep) * $tickStep;
    }

    for ($i = 0; $i < $count; $i++) {
        $logVal = $values[$i];
        if ($logVal === null || $maxTick <= 0) {
            continue;
        }
        $originalVal = $logVal;
        if ($logVal < 0) {
            $logVal = -1 * $logVal;
        }
        $barWidthVal = ($logVal / $maxTick) * $plotWidth;
        $y1 = (int) ($topMargin + $spacing + $i * ($barHeight + $spacing));
        $y2 = $y1 + $barHeight;
        $x1 = $leftMargin;
        $x2 = (int) ($x1 + $barWidthVal);
        imagefilledrectangle($img, $x1, $y1, $x2, $y2, $blue);
        if ($originalVal <= 0) {
            $percentageText = 'skipped due to performance';
        } else {
            $percentage = ($logVal / $maxLog) * 100;
            $percentageText = sprintf('%.2f%%', $percentage);
        }
        $percentageY = (int) ($y1 + ($barHeight - imagefontheight(2)) / 2);
        $percentageX = $x2 + 5;
        imagestring($img, 2, $percentageX, $percentageY, $percentageText, $black);
        $labelLines = explode("\n", $labels[$i]);
        $totalLabelHeight = count($labelLines) * (imagefontheight(2) + 2) - 2;
        $labelY = (int) ($y1 + ($barHeight - $totalLabelHeight) / 2);
        foreach ($labelLines as $line) {
            $textWidth = imagefontwidth(2) * strlen($line);
            $textX = $leftMargin - $textWidth - 10;
            imagestring($img, 2, (int) $textX, $labelY, $line, $black);
            $labelY += imagefontheight(2) + 2;
        }
    }

    imageline($img, $leftMargin, $topMargin, $leftMargin, $topMargin + $plotHeight, $black);
    imageline($img, $leftMargin, $topMargin + $plotHeight, $leftMargin + $plotWidth, $topMargin + $plotHeight, $black);

    if ($tickStep > 0) {
        for ($tick = 0; $tick <= $maxTick; $tick += $tickStep) {
            $x = (int) ($leftMargin + ($tick / $maxTick) * $plotWidth);
            imageline($img, $x, $topMargin + $plotHeight, $x, $topMargin + $plotHeight + 5, $black);
            $label = rtrim(rtrim(sprintf('%.2f', $tick), '0'), '.');
            $textWidth = imagefontwidth(2) * strlen($label);
            imagestring($img, 2, (int) ($x - $textWidth / 2), $topMargin + $plotHeight + 10, $label, $black);
        }
    }

    imagejpeg($img, $filename, 85);
    imagedestroy($img);
}

if (!is_dir('images')) {
    mkdir('images');
}

create_bar_chart(
    $withoutStartup06,
    'Speed Comparison Without Startup Time (f06)',
    'images/speed_comparison_without_startup_f06.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup06,
    'Speed Comparison With Startup Time (f06_startup)',
    'images/speed_comparison_with_startup_f06.jpg',
    $displayNames
);
create_bar_chart(
    $withoutStartup16,
    'Speed Comparison Without Startup Time (p16)',
    'images/speed_comparison_without_startup_p16.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup16,
    'Speed Comparison With Startup Time (p16_startup)',
    'images/speed_comparison_with_startup_p16.jpg',
    $displayNames
);
create_bar_chart(
    $withoutStartup26,
    'Speed Comparison Without Startup Time (z26)',
    'images/speed_comparison_without_startup_z26.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup26,
    'Speed Comparison With Startup Time (z26_startup)',
    'images/speed_comparison_with_startup_z26.jpg',
    $displayNames
);
create_bar_chart(
    $withoutStartup06Interfaces,
    'Interface Speed Comparison Without Startup Time',
    'images/speed_comparison_interfaces_without_startup06.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup06Interfaces,
    'Interface Speed Comparison With Startup Time',
    'images/speed_comparison_interfaces_with_startup06.jpg',
    $displayNames
);
create_bar_chart(
    $withoutStartup16Interfaces,
    'Interface Speed Comparison Without Startup Time',
    'images/speed_comparison_interfaces_without_startup16.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup16Interfaces,
    'Interface Speed Comparison With Startup Time',
    'images/speed_comparison_interfaces_with_startup16.jpg',
    $displayNames
);
create_bar_chart(
    $withoutStartup26Interfaces,
    'Interface Speed Comparison Without Startup Time',
    'images/speed_comparison_interfaces_without_startup26.jpg',
    $displayNames
);
create_bar_chart(
    $withStartup26Interfaces,
    'Interface Speed Comparison With Startup Time',
    'images/speed_comparison_interfaces_with_startup26.jpg',
    $displayNames
);
