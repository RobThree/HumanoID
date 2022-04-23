<?php

namespace RobThree\HumanoID\Tests\Benchmark;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\HumanoIDs;
use RobThree\HumanoID\HumanoIDInterface;

require_once __DIR__ . '../../../vendor/autoload.php';

/**
 * @BeforeMethods("setUp")
 */
class HumanoIDCreateBench {
    public function setUp(array $params): void
    {
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideGenerators",
     *     "provideIdRange"
     * })
     */
    public function benchCreate(array $params) {
        $params['generator']->create(rand(0, $params['maxid']));
    }

    public function provideGenerators()
    {
        $generators = [
            HumanoIDs::zooIdGenerator(),
            HumanoIDs::spaceIdGenerator(),
            new HumanoID([
                'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet', 'pink', 'purple', 'white', 'black'],
                'adjectives' => ['big', 'funny', 'lazy', 'old', 'happy', 'sad', 'small', 'quick', 'clever', 'itchy', 'tame'],
                'animals' => ['dog', 'cat', 'hamster', 'goldfish', 'chicken', 'snake', 'rat', 'owl', 'shark', 'panda', 'camel']
            ])
        ];

        foreach ($generators as $gen) {
            yield ['generator' => $gen];
        }
    }

    public function provideIdRange()
    {
        $ranges = [0, 10, 1000, 1000000];
        foreach ($ranges as $r) {
            yield ['maxid' => $r];
        }
    }
}