<?php

declare(strict_types=1);

namespace RobThree\HumanoID\Test\Benchmark;

use RobThree\HumanoID\HumanoID;
use RobThree\HumanoID\HumanoIDs;

abstract class BaseCreateBench {

    private HumanoID $generator;

    public function provideId()
    {
        $ranges = [10, 100, 1_000, 1_000_000, 1_000_000_000];
        foreach ($ranges as $r) {
            yield ['id' => rand(1, $r)];
        }
    }
}