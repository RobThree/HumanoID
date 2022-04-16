<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;
use RobThree\UrlGenerator\UrlGeneratorException;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see UrlGenerator
 */
class GeneratorExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyWordSetsArray(): void
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('No words specified');
        new UrlGenerator([]);
    }

    public function testWillThrowExceptionWithEmptyCategoryArray(): void
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Categories must be either: unset (enables autodetect), or an array with size > 0, or unset');
        new UrlGenerator($this->defaultWordSets, []);
    }

    public function testWillThrowExceptionOnImproperCategoryConstruction(): void
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Category "planets" not found in datafile, category is not an array or category is an empty array');
        new UrlGenerator($this->defaultWordSets, ['planets', 'space-craft', 'country']);
    }

    public function testWillThrowExceptionOnIncorrectFormat(): void
    {
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('Unsupported format "sarcastic"');
        new UrlGenerator($this->defaultWordSets, null, '-', 'sArCasTic');
    }

    public function testWillThrowExceptionWithErrantCategoryItem(): void
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

    public function testWillThrowExceptionWithNonPositiveInt(): void
    {
        $generator = new UrlGenerator($this->defaultWordSets);
        $this->expectException(UrlGeneratorException::class);
        $this->expectExceptionMessage('ID must be a postive integer');
        $generator->toURL(-43);
    }
}
