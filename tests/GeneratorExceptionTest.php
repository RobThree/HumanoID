<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator\Test;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\FutureProjectNameGenerator;
use RobThree\UrlGenerator\FutureProjectNameGeneratorException;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see FutureProjectNameGenerator
 */
class GeneratorExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyWordSetsArray(): void
    {
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('No words specified');
        new FutureProjectNameGenerator([]);
    }

    public function testWillThrowExceptionWithEmptyCategoryArray(): void
    {
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Categories must be either: unset (enables autodetect), or an array with size > 0, or unset');
        new FutureProjectNameGenerator($this->defaultWordSets, []);
    }

    public function testWillThrowExceptionOnImproperCategoryConstruction(): void
    {
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Category "planets" not found in datafile, category is not an array or category is an empty array');
        new FutureProjectNameGenerator($this->defaultWordSets, ['planets', 'space-craft', 'country']);
    }

    public function testWillThrowExceptionOnIncorrectFormat(): void
    {
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Unsupported format "sarcastic"');
        new FutureProjectNameGenerator($this->defaultWordSets, null, '-', 'sArCasTic');
    }

    public function testWillThrowExceptionWithErrantCategoryItem(): void
    {
        $categories = array_keys($this->defaultWordSets);
        $categories[] = '';
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Category "" is invalid');
        new FutureProjectNameGenerator($this->defaultWordSets, $categories);

        $categories = array_keys($this->defaultWordSets);
        $categories[] = 42;
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('Category "42" is invalid');
        new FutureProjectNameGenerator($this->defaultWordSets, $categories);
    }

    public function testWillThrowExceptionWithNonPositiveInt(): void
    {
        $generator = new FutureProjectNameGenerator($this->defaultWordSets);
        $this->expectException(FutureProjectNameGeneratorException::class);
        $this->expectExceptionMessage('ID must be a positive integer');
        $generator->create(-43);
    }
}
