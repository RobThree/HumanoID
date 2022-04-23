<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark\AlwaysNew;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\Test\Benchmark\BenchmarkBase;

class ReadsFileCreateBench extends BenchmarkBase {

    /**
     * @Revs(1000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideId"
     * })
     */
    public function benchCreateWithNew(array $params) {
        $generator = new HumanoID(
            json_decode(
                file_get_contents(dirname(__DIR__, 3) . '/data/space-words.json'),
                true
            )
        );
        $generator->create($params['id']);
    }
}