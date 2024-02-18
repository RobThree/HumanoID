<?php

declare(strict_types=1);

namespace Benchmark;

use RobThree\HumanoID\DictionaryBuilder;
use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\Test\Benchmark\BenchmarkBase;

/**
 * @BeforeMethods("setUp")
 * @AfterMethods("tearDown")
 */
class SpaceStaticBench extends BenchmarkBase {

    public function setUp()
    {
        $this->generator = new HumanoID(DictionaryBuilder::spaceWords());
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
        $spaceId = $this->generator->create($params['id']);
        $decoded = $this->generator->parse($spaceId);
        assert($params['id'] === $decoded);
    }
}