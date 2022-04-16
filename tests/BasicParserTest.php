<?php

declare(strict_types=1);

namespace RobThree\Tests\UrlGenerator;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of parsing tests.
 *
 * @see UrlGenerator
 */
class BasicParserTest extends TestCase
{
    use MatchesSnapshots;

    private $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    /**
     * @throws UrlGeneratorException
     */
    public function testCanParseIdIntoInt() {
        $generator = new UrlGenerator($this->defaultWordSets, null, '-', WordFormatEnum::ucfirst());
        $firstTwoDozenIds = [
            "Dog",
            "Cat",
            "Hamster",
            "Orange-Dog",
            "Orange-Cat",
            "Orange-Hamster",
            "Yellow-Dog",
            "Yellow-Cat",
            "Yellow-Hamster",
            "Green-Dog",
            "Green-Cat",
            "Green-Hamster",
            "Blue-Dog",
            "Blue-Cat",
            "Blue-Hamster",
            "Indigo-Dog",
            "Indigo-Cat",
            "Indigo-Hamster",
            "Violet-Dog",
            "Violet-Cat",
            "Violet-Hamster",
            "Funny-Red-Dog",
            "Funny-Red-Cat",
            "Funny-Red-Hamster",
            "Funny-Orange-Dog"
        ];

        for ($i = 0; $i <= 24; $i++) {
            $this->assertSame($i, $generator->parseUrl($firstTwoDozenIds[$i]));
        }
    }
}
