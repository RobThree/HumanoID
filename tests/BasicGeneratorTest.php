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
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormats(?WordFormatEnum $wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormatsWithoutHyphens(?WordFormatEnum $wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormatsWithNullSeperator(?WordFormatEnum $wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, null, $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateDozenRandomLargeIdsAsVariousFormats(?WordFormatEnum $wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 12; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i + 1024);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTwoDozenRandomVerLargeIdsAsVariousFormats(?WordFormatEnum $wordFormat = null): void
    {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds = [];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i + 4096);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    /**
     * @return array<array-key, array<array-key, null|WordFormatEnum>>
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
        ];
    }
}
