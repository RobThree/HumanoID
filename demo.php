<?php

use RobThree\UrlGenerator\FutureProjectName;

require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: text/plain');

// Initialize default ZooID style generator
$zooIdGenerator = FutureProjectName::zooIdGenerator();

// Generate some random id, convert that to a url and then decode it back.
$randomId = rand(0,9999999);
echo 'Random id  : ' . $randomId . PHP_EOL;

$url = $zooIdGenerator->create($randomId);
echo 'As URL     : ' . $url . PHP_EOL;

$decodedId = $zooIdGenerator->parse($url);
echo 'Decoded id : ' . $decodedId . PHP_EOL;

echo 'Check      : ' . (($decodedId === $randomId) ? 'OK' : 'FAILED!') . PHP_EOL;
