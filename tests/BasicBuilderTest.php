<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\FutureProjectName;
use RobThree\UrlGenerator\FutureProjectNameGenerator;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see FutureProjectNameGenerator
 */
class BasicBuilderTest extends BaseTestCase
{
    use MatchesSnapshots;

    public function testCanGetGeneratorFromBuilder(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $this->assertIsObject($generator);
        $this->assertInstanceOf(FutureProjectNameGenerator::class, $generator);
    }

    public function testDefaultGeneratorCanGenerateFirstTwoDozen(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->create($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    public function testDefaultGeneratorCanGenerateDozenLargeIds(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->create($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }
}
