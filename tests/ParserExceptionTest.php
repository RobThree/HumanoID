<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see UrlGenerator
 */
class ParserExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyIdInput(): void
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('No text specified');
        $generator->parseId('  ');
    }

    public function testWillThrowExceptionWithInvalidIdInput(): void
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Failed to lookup "red-mars-frogs"');
        $generator->parseId('red-mars-frogs');
    }
}
