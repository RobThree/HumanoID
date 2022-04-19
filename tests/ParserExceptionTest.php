<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\FutureProjectNameGenerator;
use RobThree\UrlGenerator\FutureProjectNameGeneratorException;

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
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('No text specified');
        $generator->parse('  ');
    }

    public function testWillThrowExceptionWithInvalidIdInput(): void
    {
        $generator = new FutureProjectNameGenerator($this->defaultWordSets);
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Failed to lookup "red-mars-frogs"');
        $generator->parse('red-mars-frogs');
    }
}
