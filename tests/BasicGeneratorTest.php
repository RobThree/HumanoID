<?php

declare(strict_types=1);

namespace RobThree\Tests\UrlGenerator;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;

/**
 * @see UrlGenerator
 */
class BasicGeneratorTest extends TestCase
{
    private $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    public function testTestVectors() {
        //TODO: Implement
    }
}
