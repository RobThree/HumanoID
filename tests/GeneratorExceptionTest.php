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
class GeneratorExceptionTest extends TestCase
{
    private $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    public function testWillThrowExceptionWithEmptyWordSetsArray()
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('No words specified');
        new UrlGenerator([]);
    }

    public function testWillThrowExceptionWithEmptyCategoryArray()
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Categories must be either: unset (enables autodetect), or an array with size > 0, or unset');
        new UrlGenerator($this->defaultWordSets, []);
    }

    public function testWillThrowExceptionOnImproperCategoryConstruction()
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Category "planets" not found in datafile, category is not an array or category is an empty array');
        new UrlGenerator($this->defaultWordSets, ['planets', 'space-craft', 'country']);
    }

    public function testWillThrowExceptionOnIncorrectFormat()
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Unsupported format "sarcastic"');
        new UrlGenerator($this->defaultWordSets, null, '-', 'sArCasTic');
    }

    public function testWillThrowExceptionWithErrantCategoryItem()
    {
        $categories = array_keys($this->defaultWordSets);
        $categories[] = '';
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Category "" is invalid');
        new UrlGenerator($this->defaultWordSets, $categories);

        $categories = array_keys($this->defaultWordSets);
        $categories[] = 42;
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Category "42" is invalid');
        new UrlGenerator($this->defaultWordSets, $categories);
    }

    public function testWillThrowExceptionWithNonPositiveInt()
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('ID must be a postive integer');
        $generator->toURL(-43);
    }
}
