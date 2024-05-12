<?php

$numItems = 1500000;
$chunkSize = 10000; // Adjust the chunk size as needed
$filename = '1-500-000-data.json';

// Open the file for writing
$fileHandle = fopen($filename, 'w');

// Write the opening bracket of the JSON array
fwrite($fileHandle, '[');

for ($i = 0; $i < $numItems; $i += $chunkSize) {
    $items = [];

    // Generate data for the current chunk
    for ($j = 0; $j < $chunkSize; $j++) {
        $items[] = [
            "uuid" => md5('voluptatem repudiandae impedit'),
            "isActive" => md5('ipsa porro aut'),
            "balance" => md5('aut ex doloribus'),
            "picture" => md5('repellendus voluptas aut'),
            "age" => md5('aut ut ea'),
            "eyeColor" => md5('impedit inventore quisquam'),
            "name" => md5('consequatur provident reprehenderit'),
            "gender" => md5('facilis blanditiis earum'),
            "company" => md5('error quasi beatae'),
            "email" => md5('veniam dolorem ea'),
            "phone" => md5('laudantium rerum voluptate'),
            "address" => md5('ut ut voluptatem'),
            "about" => md5('dolores numquam quam'),
            "registered" => md5('et in ad'),
            "latitude" => md5('eos voluptatem aliquid'),
            "longitude" => md5('est blanditiis similique'),
        ];
    }

    // Encode the chunk as JSON
    $jsonChunk = json_encode($items, JSON_PRETTY_PRINT);

    // Write the chunk to the file
    fwrite($fileHandle, $jsonChunk);

    // Add a comma if this is not the last chunk
    if ($i + $chunkSize < $numItems) {
        fwrite($fileHandle, ',');
    }
}

// Write the closing bracket of the JSON array
fwrite($fileHandle, ']');

// Close the file handle
fclose($fileHandle);

echo "Data has been written to $filename\n";
