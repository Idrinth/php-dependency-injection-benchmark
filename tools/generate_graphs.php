<?php

chdir(__DIR__ . '/..');

function format_name(string $name): string {
    if (strpos($name, '.') !== false) {
        [$first, $rest] = explode('.', $name, 2);
        return $first . "\n(" . $rest . ")";
    }
    return $name;
}

$files = glob('*.json');
if (!$files) {
    throw new RuntimeException('No benchmark result files found');
}
sort($files);
$containers = array_map(fn($f) => pathinfo($f, PATHINFO_FILENAME), $files);
$displayNames = array_map('format_name', $containers);

function extract_averages(string $filename): array {
    $data = json_decode(file_get_contents($filename), true);
    return [
        'f06' => $data['f06']['average'] ?? null,
        'f06_startup' => $data['f06_startup']['average'] ?? null,
        'z26' => $data['z26']['average'] ?? null,
        'z26_startup' => $data['z26_startup']['average'] ?? null,
        'p16' => $data['p16']['average'] ?? null,
        'p16_startup' => $data['p16_startup']['average'] ?? null,
    ];
}

function nice_number(float $value): float {
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
$withoutStartup26 = [];
$withStartup26 = [];
$withoutStartup16 = [];
$withStartup16 = [];
foreach ($containers as $container) {
    $values = extract_averages("$container.json");
    $withoutStartup06[] = $values['f06'];
    $withStartup06[] = $values['f06_startup'];
    $withoutStartup26[] = $values['z26'];
    $withStartup26[] = $values['z26_startup'];
    $withoutStartup16[] = $values['p16'];
    $withStartup16[] = $values['p16_startup'];
}

function create_bar_chart(array $values, string $title, string $filename, array $labels): void {
    $count = count($values);
    $barWidth = 40;
    $spacing = 70;
    $leftMargin = 60;
    $bottomMargin = 60;
    $topMargin = 40;
    $plotHeight = 600;
    $width = $leftMargin + $count * ($barWidth + $spacing) + $spacing;
    $height = $topMargin + $plotHeight + $bottomMargin;

    $img = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorallocate($img, 0, 0, 0);
    $blue = imagecolorallocate($img, 70, 130, 180);
    imagefill($img, 0, 0, $white);

    $titleFont = 5;
    $fontWidth = imagefontwidth($titleFont);
    $titleWidth = $fontWidth * strlen($title);
    imagestring($img, $titleFont, max(0, ($width - $titleWidth) / 2), 5, $title, $black);
    imagestringup($img, 3, 15, $height - $bottomMargin - 10, 'Seconds per 10,000', $black);

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
        if ($logVal < 0) {
            $logVal = -1 * $logVal;
        }
        $barHeight = ($logVal / $maxTick) * $plotHeight;
        $x1 = $leftMargin + $spacing + $i * ($barWidth + $spacing);
        $y1 = $topMargin + $plotHeight - $barHeight;
        $x2 = $x1 + $barWidth;
        $y2 = $topMargin + $plotHeight;
        imagefilledrectangle($img, $x1, $y1, $x2, $y2, $blue);
        $percentage = ($logVal / $maxLog) * 100;
        $percentageText = sprintf('%.1f%%', $percentage);
        $percentageWidth = imagefontwidth(2) * strlen($percentageText);
        $percentageX = $x1 + ($barWidth - $percentageWidth) / 2;
        $percentageY = $y1 - imagefontheight(2) - 2;
        imagestring($img, 2, $percentageX, $percentageY, $percentageText, $black);
        $labelLines = explode("\n", $labels[$i]);
        $labelY = $topMargin + $plotHeight + 5;
        foreach ($labelLines as $line) {
            $textWidth = imagefontwidth(2) * strlen($line);
            $textX = $x1 + ($barWidth - $textWidth) / 2;
            imagestring($img, 2, $textX, $labelY, $line, $black);
            $labelY += imagefontheight(2) + 2;
        }
    }

    imageline($img, $leftMargin, $topMargin, $leftMargin, $topMargin + $plotHeight, $black);
    imageline($img, $leftMargin, $topMargin + $plotHeight, $width - $spacing, $topMargin + $plotHeight, $black);

    if ($tickStep > 0) {
        for ($tick = 0; $tick <= $maxTick; $tick += $tickStep) {
            $y = $topMargin + $plotHeight - ($tick / $maxTick) * $plotHeight;
            imageline($img, $leftMargin - 5, $y, $leftMargin, $y, $black);
            $label = rtrim(rtrim(sprintf('%.2f', $tick), '0'), '.');
            $textWidth = imagefontwidth(2) * strlen($label);
            imagestring($img, 2, $leftMargin - $textWidth - 10, $y - imagefontheight(2) / 2, $label, $black);
        }
    }

    imagepng($img, $filename);
    imagedestroy($img);
}

create_bar_chart($withoutStartup06, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup06.png', $displayNames);
create_bar_chart($withStartup06, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup06.png', $displayNames);
create_bar_chart($withoutStartup16, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup16.png', $displayNames);
create_bar_chart($withStartup16, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup16.png', $displayNames);
create_bar_chart($withoutStartup26, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup26.png', $displayNames);
create_bar_chart($withStartup26, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup26.png', $displayNames);

copy('speed_comparison_without_startup16.png', 'speed_comparison_without_startup.png');
copy('speed_comparison_with_startup16.png', 'speed_comparison_with_startup.png');
