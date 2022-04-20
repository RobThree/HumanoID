<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test;

use RobThree\HumanoID\Exceptions\InvalidArgumentException;
use RobThree\HumanoID\Exceptions\LookUpFailureException;
use RobThree\HumanoID\HumanoID;
use TypeError;

/**
 * This set of tests will cover only the most basic kinds of tests.
 *
 * @see HumanoID
 */
class GeneratorExceptionTest extends BaseTestCase
{
    public function testWillThrowExceptionWithEmptyWordSetsArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No words specified');
        new HumanoID([]);
    }

    public function testWillThrowExceptionWithEmptyCategoryArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Categories must be either: unset (enables autodetect), or an array with size > 0, or unset');
        new HumanoID($this->defaultWordSets, []);
    }

    public function testWillThrowExceptionOnImproperCategoryConstruction(): void
    {
        $this->expectException(LookUpFailureException::class);
        $this->expectExceptionMessage('Category "planets" not found in datafile, category is not an array or category is an empty array');
        new HumanoID($this->defaultWordSets, ['planets', 'space-craft', 'country']);
    }

    public function testWillThrowExceptionOnIncorrectFormat(): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        new HumanoID($this->defaultWordSets, null, '-', 'sArCasTic');
    }

    public function testWillThrowExceptionWithErrantCategoryItem(): void
    {
        $categories = array_keys($this->defaultWordSets);
        $categories[] = '';
        $this->expectException(LookUpFailureException::class);
        $this->expectExceptionMessage('Category "" is invalid');
        new HumanoID($this->defaultWordSets, $categories);

        $categories = array_keys($this->defaultWordSets);
        $categories[] = 42;
        $this->expectException(LookUpFailureException::class);
        $this->expectExceptionMessage('Category "42" is invalid');
        new HumanoID($this->defaultWordSets, $categories);
    }

    public function testWillThrowExceptionWithNonPositiveInt(): void
    {
        $generator = new HumanoID($this->defaultWordSets);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ID must be a positive integer');
        $generator->create(-43);
    }
}
