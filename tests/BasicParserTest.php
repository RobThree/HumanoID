<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\FutureProjectNameGenerator;
use RobThree\UrlGenerator\FutureProjectNameGeneratorException;
use RobThree\UrlGenerator\WordFormatOption;

/**
 * This set of tests will cover only the most basic kinds of parsing tests.
 *
 * @see FutureProjectNameGenerator
 */
class BasicParserTest extends BaseTestCase
{
    /**
     * @throws FutureProjectNameGeneratorException
     */
    public function testCanParseIdIntoInt(): void
    {
        $generator = new FutureProjectNameGenerator($this->defaultWordSets, null, '-', WordFormatOption::ucfirst());
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
            $this->assertSame($i, $generator->parse($firstTwoDozenIds[$i]));
        }
    }
}
