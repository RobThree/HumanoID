<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark\AlwaysNew;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\Test\Benchmark\BenchmarkBase;

class CachesJsonCreateBench extends BenchmarkBase {

    public function __construct()
    {
        $this->spaceJson = json_decode(
            file_get_contents(dirname(__DIR__, 3) . '/data/space-words.json'),
            true
        );
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideId"
     * })
     */
    public function benchCreate(array $params) {
        $generator = new HumanoID($this->spaceJson);
        $generator->create($params['id']);
    }
}