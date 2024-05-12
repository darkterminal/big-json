<?php

use JsonMachine\Items;

require_once 'vendor/autoload.php';

/**
 * Display a progress bar in the CLI. This will dynamically take up the full width of the
 * terminal and if you keep calling this function, it will appear animated as the progress bar
 * keeps writing over the top of itself.
 * @link https://blog.programster.org/php-cli-progress-bar
 *
 * @param float $percentage - the percentage completed.
 * @param int $numDecimalPlaces - the number of decimal places to show for percentage output string
 */
function showProgressBar($percentage, int $numDecimalPlaces)
{
    $percentageStringLength = 4;
    if ($numDecimalPlaces > 0) {
        $percentageStringLength += ($numDecimalPlaces + 1);
    }

    $percentageString = number_format($percentage, $numDecimalPlaces) . '%';
    $percentageString = str_pad($percentageString, $percentageStringLength, " ", STR_PAD_LEFT);

    $percentageStringLength += 3; // add 2 for () and a space before bar starts.

    $terminalWidth = `tput cols`;
    $barWidth = $terminalWidth - ($percentageStringLength) - 2; // subtract 2 for [] around bar
    $numBars = round(($percentage) / 100 * ($barWidth));
    $numEmptyBars = $barWidth - $numBars;

    $barsString = '[' . str_repeat("=", ($numBars)) . str_repeat(" ", ($numEmptyBars)) . ']';

    echo "($percentageString) " . $barsString . "\r";
}

$filename = '1-500-000-data.json';
$fileSize = filesize($filename);
$user = Items::fromFile($filename, ['debug' => true]);

$start = microtime(true);
foreach ($user as $key => $data) {
    showProgressBar(intval($user->getPosition() / $fileSize * 100), 0);
}
$end = microtime(true);
$executionTime = $end - $start;
echo "Execution time: $executionTime seconds" . PHP_EOL;
