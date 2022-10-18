<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Obfuscator;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\HumanoIDInterface;
use RobThree\HumanoID\HumanoIDs;
use RobThree\HumanoID\Obfuscatories\MissyElliottObfuscator;
use RobThree\HumanoID\Test\BaseTestCase;
use RobThree\HumanoID\WordFormatOption;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see HumanoID
 */
class MissySpaceBuilderTest extends BaseTestCase
{
    use MatchesSnapshots;

    public function getGenerator(): HumanoIDInterface
    {
        return new HumanoID(
            json_decode(
                file_get_contents(__DIR__ . '/../../data/space-words.json'),
            true
            ),
            null,
            '_',
            WordFormatOption::ucfirst(),
            new MissyElliottObfuscator()
        );
    }

    public function testCanGetGeneratorFromBuilder(): void
    {
        $generator = $this->getGenerator();
        $this->assertIsObject($generator);
        $this->assertInstanceOf(HumanoID::class, $generator);
    }

    public function testDefaultGeneratorCanGenerateFirstTwoDozen(): void
    {
        $generator = $this->getGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->create($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    public function testDefaultGeneratorCanGenerateDozenLargeIds(): void
    {
        $generator = $this->getGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->create($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    public function testDefaultGeneratorCanGenerateDozenVeryLargeIds(): void
    {
        $generator = $this->getGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->create($i + 4194304);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }
}
