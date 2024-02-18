<?php

use RobThree\HumanoID\Dictionaries\Space\StarAdjectives;
use RobThree\HumanoID\Dictionaries\SpaceDictionary;
use RobThree\HumanoID\Dictionaries\ZooDictionary;
use RobThree\HumanoID\Test\BaseTestCase;

class TempDictionaryTest extends BaseTestCase
{
    public function testCurrentBuzzwords()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(71, $spaceData['buzzwords']);
        $this->assertSameSize($spaceData['buzzwords'], SpaceDictionary::buzzwords());
    }

    public function testCurrentSpaceColors()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(6, $spaceData['colors']);
        $this->assertSameSize($spaceData['colors'], StarAdjectives::colors());
    }

    public function testCurrentLifeCycle()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(5, $spaceData['life-cycle']);
        $this->assertSameSize($spaceData['life-cycle'], StarAdjectives::lifeCycles());
    }

    public function testCurrentTaxonomy()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(8, $spaceData['star-taxonomy']);
        $this->assertSameSize($spaceData['star-taxonomy'], StarAdjectives::taxonomy());
    }

    public function testCurrentPlanetoids()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(17, $spaceData['planetoids']);
        $this->assertSameSize($spaceData['planetoids'], SpaceDictionary::celestialBodies());
    }

    public function testCurrentGalaxies()
    {
        $spaceData = json_decode(
            file_get_contents(__DIR__ . '/../data/space-words.json'),
            true
        );
        $this->assertCount(9, $spaceData['galaxies']);
        $this->assertSameSize($spaceData['galaxies'], SpaceDictionary::galaxies());
    }

    public function testCurrentAdjectives()
    {
        $zooData = json_decode(
            file_get_contents(__DIR__ . '/../data/zoo-words.json'),
            true
        );
        $this->assertCount(85, $zooData['colors']);
        $this->assertSameSize($zooData['colors'], ZooDictionary::colors());
    }

    public function testCurrentAnimals()
    {
        $zooData = json_decode(
            file_get_contents(__DIR__ . '/../data/zoo-words.json'),
            true
        );
        $this->assertCount(221, $zooData['animals']);
        $this->assertSameSize($zooData['animals'], ZooDictionary::animals());
    }
}
