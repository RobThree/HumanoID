<?php

namespace RobThree\HumanoID\Test;

abstract class BaseTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array<string, array<array-key, string>>
     */
    protected array $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];
}
