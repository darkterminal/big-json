<?php

require_once 'vendor/autoload.php';

$start = microtime(true);
$no = 1;
$parser = new \JsonCollectionParser\Parser();
$parser->chunk('./100-000-data.json', function (array $chunk) use (&$no) {
    var_dump(is_array($chunk));    //true
    var_dump(count($chunk) === 25_000); //true

    foreach ($chunk as $item) {
        echo "[$no] => " . $item['uuid'] . PHP_EOL;
        $no += 1;
    }
}, 25_000);
$end = microtime(true);
$executionTime = $end - $start;
echo "Execution time: $executionTime seconds" . PHP_EOL;
