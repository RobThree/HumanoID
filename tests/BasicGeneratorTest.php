<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see UrlGenerator
 */
class BasicGeneratorTest extends BaseTestCase
{
    use MatchesSnapshots;

    /**
     * @param null|WordFormatEnum|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormats($wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormatsWithoutHyphens($wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormatsWithNullSeperator($wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, null, $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateDozenRandomLargeIdsAsVariousFormats($wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum|string $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTwoDozenRandomVerLargeIdsAsVariousFormats($wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->generate($i + 4096);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @return array<array-key, array<array-key, null|WordFormatEnum|string>>
     */
    public function provideFormatOptions(): array
    {
        return [
            [
                null,
            ],
            [
                WordFormatEnum::ucfirst(),
            ],
            [
                WordFormatEnum::lcfirst(),
            ],
            [
                WordFormatEnum::lower(),
            ],
            [
                WordFormatEnum::upper(),
            ],
            [
                'lower',
            ],
        ];
    }
}
