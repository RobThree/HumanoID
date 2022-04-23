<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark\AlwaysNew;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\Test\Benchmark\BenchmarkBase;

class CachesFileCreateBench extends BenchmarkBase {

    /**
     * @var string
     */
    private $spaceWordsContents;

    public function __construct()
    {
        $this->spaceWordsContents = file_get_contents(dirname(__DIR__, 3) . '/data/space-words.json');
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
    public function benchCreate(array $params) {
        $generator = new HumanoID(
            json_decode(
                $this->spaceWordsContents,
                true
            )
        );
        $generator->create($params['id']);
    }
}