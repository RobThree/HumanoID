<?php

namespace RobThree\HumanoID\Test\Benchmark;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\HumanoIDs;

class HumanoIDCreateBench extends BaseCreateBench {
    public function __construct()
    {
        $this->zooGenerator = HumanoIDs::zooIdGenerator();
        $this->spaceGenerator = HumanoIDs::spaceIdGenerator();
        $this->customGenerator = new HumanoID([
            'colors' => ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet', 'pink', 'purple', 'white', 'black'],
            'adjectives' => ['big', 'funny', 'lazy', 'old', 'happy', 'sad', 'small', 'quick', 'clever', 'itchy', 'tame'],
            'animals' => ['dog', 'cat', 'hamster', 'goldfish', 'chicken', 'snake', 'rat', 'owl', 'shark', 'panda', 'camel']
        ]);
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideId"
     * })
     */
    public function benchZooGenerator(array $params) {
        $this->zooGenerator->create($params['id']);
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideId"
     * })
     */
    public function benchSpaceGenerator(array $params) {
        $this->spaceGenerator->create($params['id']);
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideId"
     * })
     */
    public function benchCustomSmallerWordSetGenerator(array $params) {
        $this->customGenerator->create($params['id']);
    }
}