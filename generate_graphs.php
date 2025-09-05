<?php
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
        $data['f06']['average'] ?? null,
        $data['f06_startup']['average'] ?? null,
        $data['z26']['average'] ?? null,
        $data['z26_startup']['average'] ?? null,
    ];
}

$withoutStartup06 = [];
$withStartup06 = [];
$withoutStartup26 = [];
$withStartup26 = [];
foreach ($containers as $container) {
    [$wos26, $ws26, $wos06, $ws06] = extract_averages("$container.json");
    $withoutStartup06[] = $wos06;
    $withStartup06[] = $ws06;
    $withoutStartup26[] = $wos26;
    $withStartup26[] = $ws26;
}

function create_bar_chart(array $values, string $title, string $filename, array $labels): void {
    $count = count($values);
    $barWidth = 40;
    $spacing = 70;
    $leftMargin = 60;
    $bottomMargin = 60;
    $topMargin = 40;
    $plotHeight = 300;
    $width = $leftMargin + $count * ($barWidth + $spacing) + $spacing;
    $height = $topMargin + $plotHeight + $bottomMargin;

    $img = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorallocate($img, 0, 0, 0);
    $blue = imagecolorallocate($img, 70, 130, 180);
    imagefill($img, 0, 0, $white);

    imagestring($img, 5, max(0, ($width - 7 * strlen($title)) / 2), 5, $title, $black);
    imagestringup($img, 3, 15, $height - $bottomMargin - 10, 'Seconds per 10,000', $black);

    $logs = array_map(fn($v) => log($v, 10), $values);
    $maxLog = max($logs);
    for ($i = 0; $i < $count; $i++) {
        $logVal = $logs[$i];
        if ($logVal === null) {
            continue;
        }
        $barHeight = ($maxLog > 0) ? ($logVal / $maxLog) * $plotHeight : 0;
        $x1 = $leftMargin + $spacing + $i * ($barWidth + $spacing);
        $y1 = $topMargin + $plotHeight - $barHeight;
        $x2 = $x1 + $barWidth;
        $y2 = $topMargin + $plotHeight;
        imagefilledrectangle($img, $x1, $y1, $x2, $y2, $blue);
        $labelLines = explode("\n", $labels[$i]);
        $labelY = $topMargin + $plotHeight + 5;
        foreach ($labelLines as $line) {
            $textWidth = imagefontwidth(2) * strlen($line);
            $textX = $x1 + ($barWidth - $textWidth) / 2;
            imagestring($img, 2, $textX, $labelY, $line, $black);
            $labelY += imagefontheight(2) + 2;
        }
    }
    imagepng($img, $filename);
    imagedestroy($img);
}

create_bar_chart($withoutStartup06, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup06.png', $displayNames);
create_bar_chart($withStartup06, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup06.png', $displayNames);
create_bar_chart($withoutStartup26, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup26.png', $displayNames);
create_bar_chart($withStartup26, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup26.png', $displayNames);
