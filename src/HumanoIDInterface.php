<?php

declare(strict_types=1);

namespace RobThree\HumanoID;

interface HumanoIDInterface
{
    public function create(int $id): string;
    public function parse(string $text): int;
}
