<?php

namespace RobThree\HumanoID\Obfuscatories;

interface SymetricObfuscatorInterface
{
    public function obfuscate(int $id): int;
    public function unobfuscate(int $id): int;
}