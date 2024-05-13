<?php

$jsonString = read_json_file('/home/darkterminal/fs-museum/DARK-STATION/Workspaces/playground/php-json/500-000-data.json'); // this function build using rust

try {
    $no = 1;
    $start = microtime(true);
    $parsedJSON = simdjson_decode($jsonString, true); // this simdjson based on cpp
    foreach ($parsedJSON as $data) {
        foreach ($data as $k => $v) {
            echo "[$no] => ". $v['name'] . PHP_EOL;
            $no +=1;
        }
    }
    $end = microtime(true);
    $executionTime = $end - $start;
    echo "Execution using simdjson_decode took time: $executionTime seconds" . PHP_EOL;
} catch (RuntimeException $e) {
    echo "Failed to parse: {$e->getMessage()}\n";
}
