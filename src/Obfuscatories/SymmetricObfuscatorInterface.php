<?php

namespace RobThree\HumanoID\Obfuscatories;

interface SymmetricObfuscatorInterface
{
    public function obfuscate(int $id): int;
    public function unobfuscate(int $id): int;
}