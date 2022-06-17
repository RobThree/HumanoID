<?php

use RobThree\HumanoID\HumanoIDs;
use RobThree\HumanoID\WordFormatOption;

require_once __DIR__ . '/vendor/autoload.php';

header('Content-Type: text/plain');

// Create new instance of HumanoID via the builder
$zooIdGen = HumanoIDs::zooIdGenerator();

// Convert ID to HumanoID
$zooId = $zooIdGen->create(96712);
echo sprintf("HumanoID   : %s\n", $zooId);
// Convert back to ID
$id = $zooIdGen->parse($zooId);
echo sprintf("Decoded ID : %d\n", $id);

// Do it again with a different separator...will throw a warning...
echo "This next one will throw a warning...\n";
$zooIdGen = HumanoIDs::zooIdGenerator('_', WordFormatOption::upper(), new \RobThree\HumanoID\Obfuscatories\MissyElliottObfuscator());
$zooId = $zooIdGen->create(96712);
echo sprintf("HumanoID   : %s\n", $zooId);
// Convert back to ID
$id = $zooIdGen->parse($zooId);
echo sprintf("Decoded ID : %d\n", $id);