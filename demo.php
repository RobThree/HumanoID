<?php

require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: text/plain');

// Load words
$words = json_decode(file_get_contents('data/words.json'), true);

// Initialize URL generator
$urlgen = new RobThree\UrlGenerator\UrlGenerator($words);

// Generate some random id, convert that to a url and then decode it back.
$randomid = rand(0,9999999);
echo 'Random id  : ' . $randomid . PHP_EOL;

$url = $urlgen->toURL($randomid);
echo 'As URL     : ' . $url . PHP_EOL;

$decodedid = $urlgen->parseUrl($url);
echo 'Decoded id : ' . $decodedid . PHP_EOL;

echo 'Check      : ' . (($decodedid === $randomid) ? 'OK' : 'FAILED!') . PHP_EOL;
