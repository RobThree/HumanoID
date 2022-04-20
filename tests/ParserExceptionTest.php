<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test;

use RobThree\HumanoID\Exceptions\InvalidArgumentException;
use RobThree\HumanoID\Exceptions\LookUpFailureException;
use RobThree\HumanoID\HumanoID;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see HumanoID
 */
class ParserExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyIdInput(): void
    {
        $generator = new HumanoID($this->defaultWordSets);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No text specified');
        $generator->parse('  ');
    }

    public function testWillThrowExceptionWithInvalidIdInput(): void
    {
        $generator = new HumanoID($this->defaultWordSets);
        $this->expectException(LookUpFailureException::class);
        $this->expectExceptionMessage('Failed to lookup "red-mars-frogs"');
        $generator->parse('red-mars-frogs');
    }
}
