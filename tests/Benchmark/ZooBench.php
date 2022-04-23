<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\HumanoIDs;

/**
 * @BeforeMethods("setUp")
 * @AfterMethods("tearDown")
 */
class ZooBench extends BenchmarkBase {

    public function setUp()
    {
        $this->generator = new HumanoID(json_decode(
            file_get_contents(HumanoIDs::baseWordsPath() . '/zoo-words.json'),
            true
        ));
    }

    public function tearDown(): void
    {
        $this->generator = null;
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
        $this->generator->create($params['id']);
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @ParamProviders({
     *     "provideRandId"
     * })
     */
    public function benchCreateRand(array $params) {
        $this->generator->create($params['id']);
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
    public function benchCreateAndDecode(array $params) {
        $zooId = $this->generator->create($params['id']);
        $decoded = $this->generator->parse($zooId);
        assert($params['id'] === $decoded);
    }
}