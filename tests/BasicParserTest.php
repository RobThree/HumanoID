<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\WordFormatOption;

/**
 * This set of tests will cover only the most basic kinds of parsing tests.
 *
 * @see HumanoID
 */
class BasicParserTest extends BaseTestCase
{
    public function testCanParseIdIntoInt(): void
    {
        $generator = new HumanoID($this->defaultWordSets, null, '-', WordFormatOption::ucfirst());
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
