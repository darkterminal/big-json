<?php

function calculate_chunk_size()
{
    $total_memory_limit = ini_get('memory_limit');
    $memory_limit_bytes = parse_size($total_memory_limit);
    $available_memory = $memory_limit_bytes * 0.8;
    $chunk_size = $available_memory / 4;
    return $chunk_size;
}

function parse_size($size)
{
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
    $size = preg_replace('/[^0-9\.]/', '', $size);
    $bytes = floatval($size);


    switch (strtolower($unit)) {
        case 'g':
            $bytes *= 1024;
        case 'm':
            $bytes *= 1024;
        case 'k':
            $bytes *= 1024;
    }

    return $bytes;
}

$filename = './data/1-000-000-data.json';
$file = fopen($filename, 'r');

if ($file) {
    try {
        $no = 1;
        $start = microtime(true);
        $chunk_size = calculate_chunk_size();

        while (!feof($file)) {

            $chunk = fread($file, $chunk_size);


            $parsedJSON = simdjson_decode($chunk, true);
            foreach ($parsedJSON as $data) {
                echo "[$no] => " . $data['name'] . PHP_EOL;
                $no += 1;
            }
        }

        fclose($file);
        $end = microtime(true);
        $executionTime = $end - $start;
        echo "Reading " . number_format(($no - 1), 0, ',') . " rows using simdjson_decode took time: $executionTime seconds" . PHP_EOL;
    } catch (RuntimeException $e) {
        echo "Failed to parse: {$e->getMessage()}\n";
    }
} else {
    echo "Unable to open file: $filename";
}
