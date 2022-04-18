<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\FutureProjectName;
use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see UrlGenerator
 */
class BasicBuilderTest extends BaseTestCase
{
    use MatchesSnapshots;

    public function testCanGetGeneratorFromBuilder(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $this->assertIsObject($generator);
        $this->assertInstanceOf(UrlGenerator::class, $generator);
    }

    /**
     * @throws UrlGeneratorException
     */
    public function testDefaultGeneratorCanGenerateFirstTwoDozen(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @throws UrlGeneratorException
     */
    public function testDefaultGeneratorCanGenerateDozenLargeIds(): void
    {
        $generator = FutureProjectName::zooIdGenerator();
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }
}
