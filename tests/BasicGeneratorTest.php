<?php

declare(strict_types=1);

namespace RobThree\Tests\UrlGenerator;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of generation tests.
 *
 * @see UrlGenerator
 */
class BasicGeneratorTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @var UrlGenerator
     */
    private $generator;

    private $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    /**
     * @param null|WordFormatEnum $wordFormat
     *
     * @dataProvider provideFormatOptions
     * @throws UrlGeneratorException
     */
    public function testCanGenerateTheFirstTwoDozenIdsAsVariousFormats(?WordFormatEnum $wordFormat = null) {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds =[];
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
    public function testCanGenerateDozenRandomLargeIdsAsVariousFormats(?WordFormatEnum $wordFormat = null) {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds =[];
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
    public function testCanGenerateTwoDozenRandomVerLargeIdsAsVariousFormats(?WordFormatEnum $wordFormat = null) {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', $wordFormat);
        $firstTwoDozenIds =[];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $generator->toURL($i + 4096);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }

    public function provideFormatOptions()
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
