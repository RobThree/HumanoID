<?php

namespace Dictionary;

use RobThree\HumanoID\Dictionaries\Colors;
use RobThree\HumanoID\Dictionaries\Space\CelestialBodies;
use RobThree\HumanoID\Dictionaries\Space\StarAdjectives;
use RobThree\HumanoID\Dictionaries\Zoo\Animals;
use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\Test\BaseTestCase;
use RobThree\HumanoID\WordFormatOption;
use Spatie\Snapshots\MatchesSnapshots;

class CustomDictionaryGeneratorTest extends BaseTestCase
{
    use MatchesSnapshots;


    /**
     * @param null|WordFormatOption|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormats($wordFormat = null): void
    {
        $customDictionary = [
            ...StarAdjectives::dictionary(),
            'colors' => Colors::all(),
            'animals' => [
                ...Animals::terrestrial(),
                ...Animals::amphibians(),
                ...Animals::arthropods(),
            ],
            'planets' => CelestialBodies::planets(),
        ];
        $generator = new HumanoID($customDictionary, null, '-', $wordFormat);
        $twoDozenIds = [];
        for ($i = 0; $i <= 6; $i++) {
            $twoDozenIds[] = $generator->create($i + 900);
        }
        for ($i = 0; $i <= 6; $i++) {
            $twoDozenIds[] = $generator->create($i + 42_000);
        }
        for ($i = 0; $i <= 6; $i++) {
            $twoDozenIds[] = $generator->create($i + 4_000);
        }
        for ($i = 0; $i <= 6; $i++) {
            $twoDozenIds[] = $generator->create($i + 128_042);
        }
        $this->assertMatchesJsonSnapshot($twoDozenIds);
    }

    /**
     * @return array<array-key, array<array-key, null|WordFormatOption|string>>
     */
    public function provideFormatOptions(): array
    {
        return [
            [
                null,
            ],
            [
                WordFormatOption::ucfirst(),
            ],
            [
                WordFormatOption::lcfirst(),
            ],
            [
                WordFormatOption::lower(),
            ],
            [
                WordFormatOption::upper(),
            ],
        ];
    }
}
