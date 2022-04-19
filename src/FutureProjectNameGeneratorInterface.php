<?php

namespace RobThree\UrlGenerator;

interface FutureProjectNameGeneratorInterface
{
    public function create(int $id): string;
    public function parse(string $text): int;
}