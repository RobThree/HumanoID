<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\Exceptions\InvalidArgumentException;
use RobThree\UrlGenerator\Exceptions\LookUpFailureException;
use RobThree\UrlGenerator\FutureProjectNameGenerator;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see FutureProjectNameGenerator
 */
class ParserExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyIdInput(): void
    {
        $generator = new FutureProjectNameGenerator($this->defaultWordSets);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No text specified');
        $generator->parse('  ');
    }

    public function testWillThrowExceptionWithInvalidIdInput(): void
    {
        $generator = new FutureProjectNameGenerator($this->defaultWordSets);
        $this->expectException(LookUpFailureException::class);
        $this->expectExceptionMessage('Failed to lookup "red-mars-frogs"');
        $generator->parse('red-mars-frogs');
    }
}
