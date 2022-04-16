<?php

declare(strict_types=1);

namespace RobThree\Tests\UrlGenerator;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;
use RobThree\UrlGenerator\WordFormatEnum;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see UrlGenerator
 */
class ParserExceptionTest extends TestCase
{
    private array $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    public function testWillThrowExceptionWithEmptyIdInput()
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('No text specified');
        $generator->parseUrl('  ');
    }

    public function testWillThrowExceptionWithInvalidIdInput()
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Failed to lookup "red-mars-frogs"');
        $generator->parseUrl('red-mars-frogs');
    }
}
