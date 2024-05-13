<?php

$numItems = 1_500_000;
$filename = '1-500-000-data.json';

$data = [
    "uuid" => "voluptatem repudiandae impedit",
    "isActive" => "ipsa porro aut",
    "balance" => "aut ex doloribus",
    "picture" => "repellendus voluptas aut",
    "age" => "aut ut ea",
    "eyeColor" => "impedit inventore quisquam",
    "name" => "consequatur provident reprehenderit",
    "gender" => "facilis blanditiis earum",
    "company" => "error quasi beatae",
    "email" => "veniam dolorem ea",
    "phone" => "laudantium rerum voluptate",
    "address" => "ut ut voluptatem",
    "about" => "dolores numquam quam",
    "registered" => "et in ad",
    "latitude" => "eos voluptatem aliquid",
    "longitude" => "est blanditiis similique",
];

$items = [];
for ($i=0; $i < $numItems; $i++) {
    array_push($items, $data);
}
file_put_contents('./data/' . $filename, json_encode($items));

echo "Data has been written to $filename\n";
