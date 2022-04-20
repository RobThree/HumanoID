<?php

use RobThree\HumanoID\HumanoIDs;

require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: text/plain');

// Initialize default ZooID style generator
$zooIdGenerator = HumanoIDs::zooIdGenerator();

// Generate some random id, convert that to a HumanoID and then decode it back.
$randomId = rand(0,9999999);
echo 'Random id  : ' . $randomId . PHP_EOL;

$hid = $zooIdGenerator->create($randomId);
echo 'As HumanoID: ' . $hid . PHP_EOL;

$decodedId = $zooIdGenerator->parse($hid);
echo 'Decoded id : ' . $decodedId . PHP_EOL;

echo 'Check      : ' . (($decodedId === $randomId) ? 'OK' : 'FAILED!') . PHP_EOL;
