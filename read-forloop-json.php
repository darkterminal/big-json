<?php

use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

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
// showProgressBar(intval($user->getPosition() / $fileSize * 100), 0) . PHP_EOL;

$filename = '../jsonrw/test-result.json';
$fileSize = filesize($filename);
$user = Items::fromFile($filename, ['decoder' => new ExtJsonDecoder(true)]);

$start = microtime(true);
$no = 1;
foreach ($user as $key => $data) {
    $count = count($data); // Cache the count
    for ($i = 0; $i < $count; $i++) {
        $v = $data[$i];
        echo "[$no] => " . $v['name'] . PHP_EOL;
        $no += 1;
    }
}
$end = microtime(true);
$executionTime = $end - $start;
echo "Execution using for-loop took time: $executionTime seconds" . PHP_EOL;
