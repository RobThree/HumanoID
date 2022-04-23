<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark;

use RobThree\HumanoID\HumanoID;

abstract class BenchmarkBase {

    protected ?HumanoID $generator;

    public function provideId()
    {
        $benchIds = [
            9,
            42,
            100,
            420,
            1_000,
            42_069,
            1_000_000,
            1_000_000_000
        ];
        foreach ($benchIds as $id) {
            yield ['id' => $id];
        }
    }

    public function provideRandId()
    {
        $ranges = [10, 100, 1_000, 1_000_000, 1_000_000_000];
        foreach ($ranges as $r) {
            yield ['id' => rand(1, $r)];
        }
    }
}