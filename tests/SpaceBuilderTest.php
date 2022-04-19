<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\FutureProjectName;
use RobThree\UrlGenerator\FutureProjectNameGenerator;
use RobThree\UrlGenerator\FutureProjectNameGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see FutureProjectNameGenerator
 */
class SpaceBuilderTest extends BaseTestCase
{
    use MatchesSnapshots;

    public function testCanGetGeneratorFromBuilder(): void
    {
        $generator = FutureProjectName::spaceIdGenerator();
        $this->assertIsObject($generator);
        $this->assertInstanceOf(FutureProjectNameGenerator::class, $generator);
    }

    /**
     * @throws FutureProjectNameGeneratorException
     */
    public function testDefaultGeneratorCanGenerateFirstTwoDozen(): void
    {
        $generator = FutureProjectName::spaceIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @throws FutureProjectNameGeneratorException
     */
    public function testDefaultGeneratorCanGenerateDozenLargeIds(): void
    {
        $generator = FutureProjectName::spaceIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }
}
