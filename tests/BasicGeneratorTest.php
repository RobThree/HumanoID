<?php

declare(strict_types=1);

namespace RobThree\Tests\UrlGenerator;

use PHPUnit\Framework\TestCase;
use RobThree\UrlGenerator\UrlGenerator;
use Spatie\Snapshots\MatchesSnapshots;

/**
 * @see UrlGenerator
 */
class BasicGeneratorTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @var UrlGenerator
     */
    private $generator;

    private $defaultWordSets = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        'animals' => ['dog', 'cat', 'hamster']
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->generator = new UrlGenerator($this->defaultWordSets);
    }

    public function testCanGenerateTheFirstTwoDozenIds() {
        $firstTwoDozenIds =[];
        for ($i = 0; $i <= 24; $i++) {
            $firstTwoDozenIds[] = $this->generator->toURL($i);
        }

        $this->assertMatchesJsonSnapshot($firstTwoDozenIds);
    }
}
